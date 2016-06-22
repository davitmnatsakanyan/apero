<?php
namespace App\Http\Controllers\Caterer\ProductManagment;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Services\ProductService;
use Auth, View, Validator;


class SingleProductController extends CatererBaseController
{
    public function getAdd(){
        return view('caterer/product/single/add');
    }

    public function postAdd(ProductService $service){
        $product = request()->except('_token');
        $ruls = [
            'name' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
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
                return redirect('caterer/product')->with('success','Product successfully add.');
           else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.')
                    ->withInput();
        }
    }
    
    public function getView(ProductService $service,$id){
        return view('caterer/product/single/view',['product' => $service->getByID($id)->getOriginal()]);
    }



    public function getEdit(ProductService $service,$id){
        return view('caterer/product/single/edit',['product' => $service->getByID($id)->getOriginal()]);
    }
    
    public function postEdit(ProductService $service,$id){
        $product = request()->except('_token');
        $ruls = [
            'name' => 'required',
            'ingredients' => 'required',
            'price' => 'required|integer',
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
            if( $service->updateById($id,$product))
                return redirect('caterer/product')->with('success','Product successfully Edited.');
            else
                return redirect()
                    ->back()
                    ->withErrors('Something went wrong.')
                    ->withInput();
        }
    }
    
    public function getDelete(ProductService $service,$id){
        if($service->deleteById($id))
            return redirect('caterer/product')->with('success','Product successfully Deleted.');
        else
            return redirect()
                ->back()
                ->withErrors('Something went wrong.');

    }
}