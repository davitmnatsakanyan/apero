<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;

use App\Models\Product;
use App\Models\Caterer;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\CatererKitchen;
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
        $this->validate($request, ['name' => 'required', 'avatar' => 'required|image', 'ingredinets' => 'required', 'price' => 'required|integer', 'caterer' => 'required', 'menu' => 'required']);
        $product = $request->except(['caterer', 'menu']);
        $product ['caterer_id'] = $request ['caterer'];
        $product ['menu_id'] = $request ['menu'];

        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $product['avatar'] = time() . "." . $extension;

        if (Product::create($product)) {
            $this->uploadFile($image, $product['avatar']);
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
        $product = Product::findOrFail($id);
        $product->menu = Menu::findOrFail($product->menu_id)->name;
        $product->caterer = Caterer::findOrFail($product->caterer_id)->name;

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
        $product = Product::findOrFail($id);

        $product->menu = Menu::findOrFail($product->menu_id)->name;
        $product->caterer = Caterer::findOrFail($product->caterer_id)->name;
        $caterers = Caterer::all();
        $menus = $this->getMenus($product->caterer_id);
        return view('admin.products.edit', compact('product', 'caterers', 'menus'));
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
        $this->validate($request, ['name' => 'required', 'ingredinets' => 'required', 'price' => 'required|integer', 'caterer' => 'required', 'menu' => 'required']);
        $data = $request->except(['caterer', 'menu']);
        $data ['caterer_id'] = $request ['caterer'];
        $data ['menu_id'] = $request ['menu'];

        if($request->avatar != NULL)
        {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $data['avatar'] = time() . "." . $extension;
        }

        $product = Product::findOrFail($id);
        $old_image = $product['avatar'];
        if ($product->update($data)) {
            $this->uploadFile($image, $product['avatar'],$old_image);
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
        unlink('images/cproducts/' . $avatar);
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

    public function getMenus($id)
    {
        $kitchens = CatererKitchen::where('caterer_id', $id)->get();
        $i = 0;
        $data = [];
        $menus = Menu::with('kitchens')->get();
        foreach ($kitchens as $kitchen) {
            foreach ($menus as $menu)
                foreach ($menu->kitchens as $menu_kitchen)
                    if ($menu_kitchen->id == $kitchen->kitchen_id) {
                        $data[$i]['id'] = $menu->id;
                        $data[$i]['text'] = $menu->name;
                        $i++;
                    }
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
}
