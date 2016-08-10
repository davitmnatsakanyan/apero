<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

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
use Illuminate\Support\Facades\Facade;


class SingleProductController extends CatererBaseController
{

    public function getIndex()
    {
        $products = Product::with('subproducts')
            ->where('caterer_id' , $this->caterer->id())
            ->get();

        $kitchens = $products->groupBy('kitchen_id');
        foreach ($kitchens as $key =>$kitchen) {
            $kitchens [$key] = $kitchen->groupBy('menu_id');

            foreach($kitchens [$key]  as $key2 => $menu)
                $kitchens [$key][$key2]['name'] = Menu::findOrFail($key2)->name;

            $kitchens [$key]['name'] = Kitchen::findOrFail($key)->name;

        }
        return view('caterer/product/single/index', compact('kitchens'));
    }

    public function getKitchens()
    {
        $caterer = Caterer::with('kitchens')->findOrFail($this->caterer->id());
        return response()->json(['caterer' => $caterer, 'success' => 1 ]);
    }


    public function getAdd()
    {

        $kitchens = Caterer::with('kitchens')->find($this->caterer->id())->kitchens;
        return view('caterer/product/single/add', compact('kitchens'));
    }

    public function getMenus($id)
    {
//        $menus = Menu::with(['kitchens' => function ($kitchen) use($id) {
//            $kitchen->where('kitchens.id', $id);
//        }])->get()->filter(function ($item) {
//            return count($item->kitchens) > 0;
//        })->all();

        $kitchen = Kitchen::with(['menus' => function($menu){
            $menu->with(['products' => function($product){
                $product->where('caterer_id',$this->caterer->id());
            }]);
        }])->findOrFail($id);
        $menus = $kitchen->menus;

        $filtered = $menus ->filter(function($menu){
            return count($menu->products) >0;
        });
//        dd($filtered);
        return response()->json(['success' => 1, 'menus' => $filtered ]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'avatar' => 'required|image',
            'ingredinets' => 'required',
            'price' => 'required_without_all:customize|integer',
            'customize.*.name' => 'required_without:price',
            'customize.*.price' => 'required_without:price|integer',
            'menu' => 'required',
            'kitchen' => 'required',
        ]);

        $product = $request->except('menu','kitchen');
        $product ['caterer_id'] = $this->caterer->id();
        $product ['menu_id'] = $request->menu;
        $product ['kitchen_id'] = $request->kitchen;

        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $product['avatar'] = time() . "." . $extension;

        if ($product = Product::create($product)) {
            $this->uploadFile($image, $product['avatar']);
            if (!is_null($request->customize))
                foreach ($request->customize as $customize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $customize['price'],
                        'name' => $customize['name'],
                    ]);
            return redirect('caterer/product/single')->with('success', 'Product successfully added.');
        } else {
            return back()->withErrors('Something went wrong.');
        }
    }

    public function getView(ProductService $service, $id)
    {
        if ($this->hasAccess($service, $id)) {
            $product = Product::with('kitchen','menu','subproducts')->findOrFail($id);
            return view('caterer/product/single/view', compact('product'));
        } else {
            return redirect()->back()->withErrors('You have no access.');
        }
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

    public function postEdit(ProductService $service, $id)
    {
        if ($this->hasAccess($service, $id)) {
            $request = request();

            $this->validate($request, [
                'name' => 'required',
                'avatar' => 'image',
                'ingredinets' => 'required',
            ]);

            if(isset($request->price))
                $this->validate($request,[
                    'price' => 'required',
                ]);

            $data = request()->except('avatar');

            if(isset($request->customize)) {
                $this->validate($request, [
                    'customize.*.name' => 'required',
                    'customize.*.price' => 'required|integer',
                ]);

                $data['price'] = 0;
            }

            if (!is_null($request->customize))
                $data['price'] = 0;

            $old_image = NULL;
            if ($request->avatar != NULL) {
                $image = $request->file('avatar');
                $extension = $image->getClientOriginalExtension();
                $data['avatar'] = time() . "." . $extension;
                $product = Product::findOrFail($id);
                $old_image = $product['avatar'];
            } else {
                $product = Product::findOrFail($id);
            }

            if ($product->update($data)) {
                $product = Product::findOrFail($id);
                if (!is_null($request->customize))
                    foreach ($request->customize as $customize)
                        Subproduct::create([
                            'product_id' => $product->id,
                            'price' => $customize['price'],
                            'name' => $customize['name'],
                        ]);
                if ($request->avatar != NULL)
                $this->uploadFile($image, $product['avatar'], $old_image);

                return redirect('caterer/product/single/view/' . $id)->with('success', 'Product updated successfully.');
            } else {
                return back()->withErrors('Something went wrong.');
            }
        } else {
            return redirect()->back()->withErrors('You have no access.');
        }
    }

    public function postUpdateSubproduct(Request $request)
    {
        $subproduct = Subproduct::findOrFail( $request->id);
            if($subproduct->update(['name' => $request->name,'price' => $request->price]) )
                return back()->with('success','Subproduct updated successfully.');
            return back()->withErrors('Something went wrong.');

        return back();
    }

    public function postDeleteSubproduct( Request $request)
    {
        $subproduct = Subproduct::findOrFail( $request->id);
        if(Product::findOrFail($subproduct->product_id)->caterer_id === $this->caterer->id())
        {
            if($subproduct->delete() )
                return back()->with('success','Subproduct deleted successfully.');
            return back()->withErrors('Something went wrong.');
        }

        return back();
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


    public function hasAccess(ProductService $service, $id)
    {
        return $this->caterer->id() == $service
            ->getById($id)
            ->getOriginal()['caterer_id'];
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
}