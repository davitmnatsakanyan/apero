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
use Illuminate\Support\Facades\Facade;


class SingleProductController extends CatererBaseController
{

    public function getProducts($kitchen_id,$menu_id)
    {
        $products = Product::where(['caterer_id' => $this->caterer->id(),'kitchen_id' => $kitchen_id,'menu_id' => $menu_id ])->get();
//        dd($products);
        return response()->json(['success' => 1, 'products' => $products]);
    }

    public function getKitchens()
    {
        $caterer = Caterer::with(['kitchens'=>function($kitchen){
            $kitchen->with(['products'=> function($product){
                $product->where('caterer_id',$this->caterer->id());
            }]);
        }])->findOrFail($this->caterer->id());

        $filtered = $caterer->kitchens->filter(function($kitchen){
        return count($kitchen->products) >0;
    });
        $caterer->kitchens = $filtered;
        return response()->json(['caterer' => $caterer, 'success' => 1 ]);
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
        $kitchen = Kitchen::with(['menus' => function($menu){
            $menu->with(['products' => function($product){
                $product->where('caterer_id',$this->caterer->id());
            }]);
        }])->findOrFail($id);
        $menus = $kitchen->menus;

        $filtered = $menus ->filter(function($menu){
            return count($menu->products) >0;
        });

        return response()->json(['success' => 1, 'menus' => $filtered ]);
    }

    public function postAdd(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
//            'avatar' => 'required|image',
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

//        $image = $request->file('avatar');
//        $extension = $image->getClientOriginalExtension();
//        $product['avatar'] = time() . "." . $extension;

        if ($product = Product::create($product)) {
//            $this->uploadFile($image, $product['avatar']);
            if (!is_null($request->customize))
                foreach ($request->customize as $customize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $customize['price'],
                        'name' => $customize['name'],
                    ]);
            return responce()->json(['success' => 1, 'message' => 'Product successfully added.']);
        } else {
            return responce()->json(['success' => 0, 'error' => 'Something went wrong.']);
        }
    }

    public function getView( $id)
    {
        if (!$this->hasAccess($id))
            return response()->json(['success' => 0 , 'error' => 'Something went wrong.']);
            
        $product = Product::with('kitchen','menu','subproducts')->findOrFail($id);
        return response()->json(['success' => 1 , 'product' => $product]);
       
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


    public function hasAccess( $id)
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
}