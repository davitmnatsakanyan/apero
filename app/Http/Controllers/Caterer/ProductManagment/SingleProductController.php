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
use Auth, View, Validator,Image;



class SingleProductController extends CatererBaseController
{

    public function getIndex(ProductService $productService, CategoryService $categotyService )
    {

          $kitchens = Kitchen::with(['menus' => function ($menu){
            $menu->with(['products' => function($product)
            {
                $product->where('caterer_id',$this->caterer->id());
            }]);
        }])->get()->filter(function($kitchen){
             $flag =false;
             if( count($kitchen->menus)>0)
                 foreach($kitchen->menus as $menu)
                      if(count($menu->products)>0)
                          $flag =true;

             return $flag;
         });

        return view('caterer/product/single/index',compact('kitchens'));
    }


    public function getAdd(CategoryService $categoryService){

        $kitchens = Caterer::with('kitchens')->find($this->caterer->id())->kitchens;
        return view('caterer/product/single/add',compact('kitchens'));
    }
    
    public function getMenus($id)
    {
      //  dd(request()->id);
      $menus = Menu::with(['kitchens' => function($kitchen){
                $kitchen->where('kitchens.id',request()->id);
        }])->get()->filter(function($item){
           return count($item->kitchens) > 0;
       })->all();


        $data = [];
        $i = 0;
        foreach($menus as $menu) {
            $data[$i]['id'] = $menu->id;
            $data[$i++]['text'] = $menu->name;
        }

        return $data;
    }

    public function postAdd(){
        $this->validate(request(), ['name' => 'required', 'avatar' => 'required|image', 'ingredinets' => 'required', 'price' => 'required|integer', 'menu' => 'required']);
        $product = request()->except( 'menu');
        $product ['caterer_id'] = $this->caterer->id();
        $product ['menu_id'] = request()->menu;

        $image = request()->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $product['avatar'] = time() . "." . $extension;

        if (Product::create($product)) {
            $this->uploadFile($image, $product['avatar']);
            return redirect('caterer/product/single')->with('success', 'Product successfully added.');
        } else {
            return back()->withErrors('Something went wrong.');
        }
    }
    
    public function getView(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            $product = Product::findOrFail($id);
            $product['menu'] = Menu::findOrFail($product->menu_id)->name;
            return view('caterer/product/single/view', compact('product'));
        }

        else{
            return redirect()->back()->withErrors('You have no access.');
        }
    }



    public function getEdit(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            $product = Product::findOrFail($id);
            return view('caterer/product/single/edit',compact('product'));
        }

        else{
            return redirect()->back()->withErrors('You have no access.');
        }
    }
    
    public function postEdit(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            $this->validate(request(), ['name' => 'required', 'ingredinets' => 'required', 'price' => 'required|integer']);
            $data = request()->except('avatar');
            $old_image = NULL;
            if(request()->avatar != NULL)
            {
                $image = request()->file('avatar');
                $extension = $image->getClientOriginalExtension();
                $data['avatar'] = time() . "." . $extension;
                $product = Product::findOrFail($id);
                $old_image = $product['avatar'];
            }

            else {
                $product = Product::findOrFail($id);
            }

            if ($product->update($data)) {
                $this->uploadFile($image, $product['avatar'],$old_image);
                return redirect('caterer/product/single/view/' . $id)->with('success', 'Product updated successfully.');
            } else {
                return back()->withErrors('Something went wrong.');
            }
        }
        else{
            return redirect()->back()->withErrors('You have no access.');
        }
    }
    
    public function getDelete(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            if ($service->deleteById($id))
                return redirect('caterer/product/single')->with('success', 'Product successfully Deleted.');
            else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.');
        }
        else{
            return redirect()->back()->withErrors('You have no access.');
        }

    }


    public function hasAccess(ProductService $service,$id){
        return $this->caterer->id() == $service
            ->getById($id)
            ->getOriginal()['caterer_id'];
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