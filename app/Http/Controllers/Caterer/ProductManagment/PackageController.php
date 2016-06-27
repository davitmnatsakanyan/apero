<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\CategoryService;
use App\Http\Services\PackageService;
use App\Http\Services\ProductService;
use App\Models\Package;
use App\Models\Category;
use App\Models\Product;

class PackageController extends CatererBaseController{

    public function getIndex(){
        $packages = Package::with('products')->get()->where('caterer_id',$this->caterer->id())->toArray();
        return view('caterer/product/package/index',compact('packages'));
    }

    public function getAdd(){
        $categories = Category::get()->all();
        $data=[];
        foreach($categories as $key => $category){
            $data[$key]['id'] = $category->id;
            $data[$key]['name'] = $category->name;
        }
        $categories = $data;
        return view('caterer/product/package/add',compact('categories'));
    }

    public function postAdd(PackageService $packageService){
        
    }

    public function getDelete(ProductService $service,$id){
        if($this->hasAccess($service,$id)->caterer_id) {
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
            ->getById($id);
    }
    
    public  function getProducts($category_id){
        $data = [];
        foreach( Category::find($category_id)->products as $key => $product){
            $data[$key]['id'] = $product->id;
            $data[$key]['text'] = $product->name;
        }

        return  $data;
    }
}