<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\ProductService;
use App\Http\Services\CategoryService;
use Auth, View, Validator;


class SingleProductController extends CatererBaseController
{

    public function getIndex(ProductService $productService, CategoryService $categotyService )
    {
        $categories = $categotyService->getAll();
        $products=[];

        foreach($categories as $category){
            $products[$category['name']] = $productService->getByData([
                'caterer_id'  => $this->caterer->id(),
                'category_id' => $category['id'],
            ]);
        }

        return view('caterer/product/single/index',['products' => $products]);
    }


    public function getAdd(CategoryService $categoryService){
        return view('caterer/product/single/add',['categories' => $categoryService->getAll()]);
    }

    public function postAdd(ProductService $service){
        $product = request()->except('_token');
        $ruls = [
            'name' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required',
        ];
        $val=Validator::make($product,$ruls);
        if($val->fails()) {
            return redirect()
                ->back()
                ->withErrors($val)
                ->withInput();
        }
        else {
            $product['caterer_id'] = $this->caterer->id();
           if( $service->create($product))
                return redirect('caterer/product/single')->with('success','Product successfully add.');
           else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.')
                    ->withInput();
        }
    }
    
    public function getView(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            return view('caterer/product/single/view', ['product' => $service->getByID($id)->getOriginal()]);
        }

        else{
            return redirect()->back()->withErrors('You have no access.');
        }
    }



    public function getEdit(ProductService $service,CategoryService $catService,$id){
        if($this->hasAccess($service,$id)) {
            return view('caterer/product/single/edit', [
                'product' => $service->getByID($id)->getOriginal(),
                'categories' => $catService->getAll()
            ]);
        }

        else{
            return redirect()->back()->withErrors('You have no access.');
        }
    }
    
    public function postEdit(ProductService $service,$id){
        if($this->hasAccess($service,$id)) {
            $product = request()->except('_token');
            $ruls = [
                'name' => 'required',
                'ingredients' => 'required',
                'price' => 'required|integer',
            ];
            $val = Validator::make($product, $ruls);
            if ($val->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($val)
                    ->withInput();
            } else {
                $product['caterer_id'] = $this->caterer->id();
                if ($service->updateById($id, $product))
                    return redirect('caterer/product/single')->with('success', 'Product successfully Edited.');
                else
                    return redirect()
                        ->back()
                        ->withErrors('Something went wrong.')
                        ->withInput();
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
}