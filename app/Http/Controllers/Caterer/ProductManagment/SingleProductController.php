<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\ProductService;
use App\Http\Services\CategoryService;
use App\Http\Requests;
use App\Models\Menu;
use App\Models\Kitchen;
use App\Models\Caterer;
use App\Models\Product;
use App\Models\Subproduct;
use Auth, View, Validator, Image;


class SingleProductController extends CatererBaseController
{

    public function getIndex(ProductService $productService, CategoryService $categotyService)
    {

        $kitchens = Kitchen::with(['caterers' => function($caterers){
            $caterers->where('caterer_id', $this->caterer->id());
        }, 'menus' => function ($menu) {
            $menu->with('products');
        }])->has('menus', '>', 0)->get();

        $kitchens = Caterer::with(['products', 'kitchens' => function($kitchens){
            $kitchens->with(['menus' => function($menus){

                $menus->with('products');
            }]);
        }])->findOrFail($this->caterer->id());

//        dd($kitchens);

        return view('caterer/product/single/index', compact('kitchens'));
    }


    public function getAdd(CategoryService $categoryService)
    {

        $kitchens = Caterer::with('kitchens')->find($this->caterer->id())->kitchens;
        return view('caterer/product/single/add', compact('kitchens'));
    }

    public function getMenus($id)
    {
        $menus = Menu::with(['kitchens' => function ($kitchen) {
            $kitchen->where('kitchens.id', request()->id);
        }])->get()->filter(function ($item) {
            return count($item->kitchens) > 0;
        })->all();


        $data = [];
        $i = 0;
        foreach ($menus as $menu) {
            $data[$i]['id'] = $menu->id;
            $data[$i++]['text'] = $menu->name;
        }

        return $data;
    }

    public function postAdd()
    {

        $this->validate(request(), [
            'name' => 'required',
            'avatar' => 'required|image',
            'ingredinets' => 'required',
            'price' => 'required_without_all:costumize|integer',
            'costumize.*.name' => 'required_without:price',
            'costumize.*.price' => 'required_without:price|integer',
            'menu' => 'required'
        ]);

        $product = request()->except('menu');
        $product ['caterer_id'] = $this->caterer->id();
        $product ['menu_id'] = request()->menu;

        $image = request()->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $product['avatar'] = time() . "." . $extension;

        if ($product = Product::create($product)) {
            $this->uploadFile($image, $product['avatar']);
            if (!is_null(request()->costumize))
                foreach (request()->costumize as $costumize)
                    Subproduct::create([
                        'product_id' => $product->id,
                        'price' => $costumize['price'],
                        'name' => $costumize['name'],
                    ]);
            return redirect('caterer/product/single')->with('success', 'Product successfully added.');
        } else {
            return back()->withErrors('Something went wrong.');
        }
    }

    public function getView(ProductService $service, $id)
    {
        if ($this->hasAccess($service, $id)) {
            $product = Product::with('subproducts')->findOrFail($id);
            $product['menu'] = Menu::findOrFail($product->menu_id)->name;
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

    public function postUpdateSubproduct()
    {
        $request =  request();
        $subproduct = Subproduct::findOrFail( $request->id);
        if(Product::findOrFail($subproduct->product_id)->caterer_id === $this->caterer->id())
        {
            if($subproduct->update(['name' => $request->name,'price' => $request->price]) )
                return back()->with('success','Subproduct updated successfully.');
            return back()->withErrors('Something went wrong.');
        }

        return back();
    }

    public function postDeleteSubproduct()
    {
        $request =  request();
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