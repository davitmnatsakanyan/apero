<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Product;
use App\Models\Caterer;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\KitchenMenu;
use App\Models\CatererKitchen;
use App\Models\Subproduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session, Image;

class ProductsController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $caterers = Caterer::all();
        return view('admin.products.create', compact('caterers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'caterer' => 'required',
            'kitchen' => 'required',
            'menu' => 'required',
            'name' => 'required',
            'avatar' => 'required',
            'ingredinets' => 'required',
            'price' => 'required_without_all:customize|integer',
            'customize.*.name' => 'required_without:price',
            'customize.*.price' => 'required_without:price|integer',
        ]);


        $product = $request->except(['caterer', 'menu']);
        $product ['caterer_id'] = $request ['caterer'];
        $product ['menu_id'] = $request ['menu'];
        $product ['kitchen_id'] = $request ['kitchen'];

        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $product['avatar'] = time() . "." . $extension;

        if (Product::create($product)) {
            $this->uploadFile($image, $product['avatar']);
            if (!is_null($request->costumize))
                foreach ($request->costumize as $costumize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $costumize['price'],
                        'name' => $costumize['name'],
                    ]);
            return redirect('admin/products')->with('success', 'Product successfully added.');
        } else {
            return back()->withErrors('Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        $product = Product::with('caterer','menu','kitchen','subproducts')->findOrFail($id);
        

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
        $product = Product::with('caterer','kitchen','menu','subproducts')->findOrFail($id);
        $caterers = Caterer::all();
        $kitchens = $this->getKitchens($product->caterer->id);
        $menus = $this->getMenus($product->kitchen->id);
        return view('admin.products.edit', compact('product', 'caterers','kitchens', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'caterer' => 'required',
            'kitchen' => 'required',
            'menu' => 'required',
            'name' => 'required',
            'ingredinets' => 'required',
            'price' => 'required_without_all:customize|integer',
            'customize.*.name' => 'required_without:price',
            'customize.*.price' => 'required_without:price|integer',
        ]);

        $data = $request->except(['caterer', 'menu','kitchen' ,'customize']);
        $data ['caterer_id'] = $request ['caterer'];
        $data ['menu_id'] = $request ['menu'];
        $data ['kitchen_id'] = $request ['kitchen'];
        $product = Product::findOrFail($id);

        if($request->avatar != NULL)
        {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $data['avatar'] = time() . "." . $extension;
            $old_image = $product['avatar'];
            $this->uploadFile($image, $product['avatar'],$old_image);
        }


        if ($product->update($data)) {
            if (!is_null($request->customize))
                foreach ($request->customize as $customize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $customize['price'],
                        'name' => $customize['name'],
                    ]);
            return redirect('admin/products')->with('success', 'Product updated successfully.');
        } else {
            return back()->withErrors('Something went wrong.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $product = Product::withTrashed()->where('id', $id)->get();
        $avatar = $product[0]->avatar;
        unlink('images/products/' . $avatar);
        Product::withTrashed()->where('id', $id)->forceDelete();

        return redirect('admin/products')->with('success', 'Product successfully deleted.');
    }


    public function block($id)
    {
        Product::destroy($id);

        return redirect('admin/products')->with('success', 'Product successfully blocked.');
    }

    public function blockedProducts()
    {
        $products = Product::onlyTrashed()->get();

        return view('admin.products.blocked', compact('products'));
    }

    public function activate($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();
         $menu = Menu::onlyTrashed()->where('id', $product->menu_id)->get()->toArray();

        if( empty($menu))
        {
            Product::withTrashed()->where('id', $id)->restore();
            return redirect('admin/products')->with('success', 'Product successfully activated.');
        }

        return back()->withErrors('product menu is blocked,please at first <a href = ' . url( 'admin/menus/' . $menu[0]['id'] . '/activate').'>activate menu</a>.' );
    }


    public function getKitchens($id)
    {
        $kitchens = CatererKitchen::where('caterer_id',$id)->lists('kitchen_id');
        $kitchens = Kitchen::whereIn('id', $kitchens)->lists('name','id');
        $i = 0;
        foreach ($kitchens as $key => $value)
        {
            $data[$i]['id'] = $key;
            $data[$i]['text'] = $value;
            $i++;
        }

        return $data;
    }

    public function getMenus($id)
    {
        $menus = KitchenMenu::where('kitchen_id',$id)->lists('kitchen_id');
        $menus = Menu::whereIn('id', $menus)->lists('name','id');
        $i = 0;
        foreach ($menus as $key => $value)
        {
            $data[$i]['id'] = $key;
            $data[$i]['text'] = $value;
            $i++;
        }

        return $data;
    }


    public function uploadFile($image, $avatar, $old_image = null)
    {
        if (!is_null($old_image)) {
            $file = 'images/products/' . $old_image;
            if(file_exists($file))
            unlink($file);
        }
        $destinationPath = 'images/products/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
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
            if($subproduct->delete() )
                return back()->with('success','Subproduct deleted successfully.');
            return back()->withErrors('Something went wrong.');

        return back();
    }
}
