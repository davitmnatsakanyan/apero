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
        return view('caterer/product/package/index',['packages' => $packages ]);
    }




    public function getAdd(){
      //  $catModel = new Category();
      //  $categories = $catModel->products()->get()->where('caterer_id',$this->caterer->id())->toArray();
        $categories = Product::with('categories')->get()->where('caterer_id',$this->caterer->id())->toArray();

        dd($categories);
        return view('caterer/product/package/add',['categories' => $categories]);
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
}