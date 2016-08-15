<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Events\restore;
use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\ProductService;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;
use App\Models\CatererKitchen;
use App\Models\Menu;
use App\Models\KitchenMenu;
use App\Models\Kitchen;
use App\Models\Caterer;
use App\Models\Product;
use App\Models\Subproduct;
use Auth, View, Validator, Image;
use Flow\Config;
use Illuminate\Support\Facades\Facade;


class SingleProductController extends CatererBaseController
{

    public function getProducts($kitchen_id, $menu_id)
    {
        $products = Product::where(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $kitchen_id, 'menu_id' => $menu_id])->get();
//        dd($products);
        return response()->json(['success' => 1, 'products' => $products]);
    }

    public function getKitchens()
    {
        $caterer = Caterer::with(['kitchens' => function ($kitchen) {
            $kitchen->with(['products' => function ($product) {
                $product->where('caterer_id', $this->caterer->id());
            }]);
        }])->findOrFail($this->caterer->id());

        $filtered = $caterer->kitchens->filter(function ($kitchen) {
            return count($kitchen->products) > 0;
        });
        $caterer->kitchens = $filtered;
        return response()->json(['caterer' => $caterer, 'success' => 1]);
    }


    public function getAllKitchens()
    {

        $kitchens = Caterer::with('kitchens')->find($this->caterer->id())->kitchens;
        return response()->json(['kitchens' => $kitchens]);
    }

    public function getAllMenus($id)
    {

        $menus = Kitchen::with('menus')->findOrFail($id)->menus;
        return response()->json(['menus' => $menus]);
    }

    public function getMenus($id)
    {
        $kitchen = Kitchen::with(['menus' => function ($menu) {
            $menu->with(['products' => function ($product) {
                $product->where('caterer_id', $this->caterer->id());
            }]);
        }])->findOrFail($id);
        $menus = $kitchen->menus;

        $filtered = $menus->filter(function ($menu) {
            return count($menu->products) > 0;
        });


        return response()->json(['success' => 1, 'menus' => $filtered]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ingredients' => 'required',
            'menu' => 'required',
            'kitchen' => 'required',
        ]);

        if (count($request->customize) > 0)
            $this->validate($request, [
                'customize.*.name' => 'required',
                'customize.*.price' => 'required|integer'
            ], ['required' => 'Customize fields required.', 'integer' => 'Subproduct price must be integer']);
        else {
            $this->validate($request, [
                'price' => 'required|integer'
            ]);
        }

        $product = $request->except('menu', 'kitchen');
        $product ['caterer_id'] = $this->caterer->id();
        $product ['menu_id'] = $request->menu;
        $product ['kitchen_id'] = $request->kitchen;


        if ($product = Product::create($product)) {
            if (!is_null($request->customize))
                foreach ($request->customize as $customize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $customize['price'],
                        'name' => $customize['name'],
                    ]);
            return response()->json(['success' => 1, 'message' => 'Product successfully added.', 'product' => $product]);
        } else {
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
        }
    }

    public function getView($id)
    {
        if (!$this->hasAccess($id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

        $product = Product::with('kitchen', 'menu', 'subproducts')->findOrFail($id);
        return response()->json(['success' => 1, 'product' => $product]);

    }


    public function getEdit(ProductService $service, $id)
    {
        if ($this->hasAccess($service, $id)) {
            $product = Product::with('subproducts')->findOrFail($id);
            return view('caterer/product/single/edit', compact('product'));
        } else {
            return redirect()->back()->withErrors('You have no access.');
        }
    }

    public function update(Request $request)
    {
        if (!$this->hasAccess($request->id))
            return response()->json(['success' => 0, 'message' => 'Something went wrong']);

        $id = $request->id;
        $data = [];

        $this->validate($request, [
            'name' => 'required',
            'ingredients' => 'required',
        ]);

        $data['name'] = $request['name'];
        $data['ingredients'] = $request['ingredients'];
        $data['kitchen_id'] = $request['kitchen']['id'];
        $data['menu_id'] = $request['menu']['id'];

        if (count($request->subproduct) <= 0)
            $this->validate($request, [
                'price' => 'required',
            ]);
        else
            $data['price'] = 0;

        $product = Product::findOrFail($id);

        if ($product->update($data))
            return response()->json(['success' => 1, 'message' => 'Product successfully updated.']);
        else
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);


    }

    public function updateSubproduct(Request $request)
    {
        $subproduct = Subproduct::findOrFail($request->id);
        if (Product::findOrFail($subproduct->product_id)->caterer_id === $this->caterer->id()) {
            if ($subproduct->update(['name' => $request->name, 'price' => $request->price]))
                return response()->json(['success' => 1, 'message' => 'Subproduct successfully updated.']);
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
    }

    public function deleteSubproduct($id)
    {
        $subproduct = Subproduct::findOrFail($id);
        if (Product::findOrFail($subproduct->product_id)->caterer_id === $this->caterer->id()) {
            if ($subproduct->delete())
                return response()->json(['success' => 1, 'message' => 'Subproduct successfully deleted.']);
            return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
        }

        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
    }

    public function getDelete(ProductService $service, $id)
    {
        if ($this->hasAccess($service, $id)) {
            $product = Product::withTrashed()->where('id', $id)->get();
            $avatar = $product[0]->avatar;
            if (file_exists('images/products/' . $avatar))
                unlink('images/products/' . $avatar);
            if (Product::withTrashed()->where('id', $id)->forceDelete())
                return redirect('caterer/product/single')->with('success', 'Product successfully Deleted.');
            else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.');
        } else {
            return redirect()->back()->withErrors('You have no access.');
        }

    }


    public function hasAccess($id)
    {
        return $this->caterer->id() == Product::findOrFail($id)->caterer_id;
    }

    public function uploadFile($image, $avatar, $old_image = null)
    {
        if (!is_null($old_image)) {
            $file = 'images/products/' . $old_image;
            if (file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/products/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . $avatar);
        return $avatar;
    }


    public function chnageAvatar(Request $request, $id)
    {

        $avatar = Product::select('avatar')->where('id', $id)->get();
        if ($avatar !== "") {
            $file = 'images/products/' . $avatar;
            if (file_exists($file))
                unlink($file);
        }
        try {

            $this->config = new Config(['tempDir' => public_path('temp')]);

            $flowRequest = new \Flow\Request();

            if (\Flow\Basic::save(
                public_path($this->getImagePublicDestinationPath($request)) . '/' . $request->input('flowFilename'), $this->config, $flowRequest)
            ) {
                Product::findOrFail($id)->update(['avatar' => $request->input('flowFilename')]);
                return response(['message' => "File Uploaded {$request->input('flowFilename')}"], 200);
            } else {
                return response([], 204);
            }
        } catch (\Exception $e) {
            throw new \Exception(sprintf("Error saving image %s", $e->getMessage()));
        }
    }

    public function getImagePublicDestinationPath(Request $request)
    {
        return ($request->input('path')) ? $request->input('path') : 'images';
    }


    public function addSubproducts(Request $request)
    {
        if (!$this->hasAccess($request->id))
            return response()->json(['success' => 0, 'error' => 'Something went wrong']);

        $this->validate($request, [
            'customize.*.name' => 'required',
            'customize.*.price' => 'required|integer',
        ]);

        $subproducts = [];
        foreach ($request->customize as $subproduct) {
            Subproduct::create([
                'name' => $subproduct['name'],
                'price' => $subproduct['price'],
                'product_id' => $request['id'],
            ]);
        }

        $subproducts = Product::with('subproducts')->findOrFail($request['id'])->subproducts;

        return response()->json(['success' => 1, 'message' => 'Subproducts added successfully', 'subproducts' => $subproducts]);
    }
}