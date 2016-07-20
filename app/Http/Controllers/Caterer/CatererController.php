<?php

namespace App\Http\Controllers\Caterer;

use App\Models\Caterer;
use App\Models\Kitchen;
use App\Models\Menu;
use App\Models\Subproduct;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatererController extends Controller
{
    public function getCaterer($id){

         $menus = Menu::with(['products' => function($product) use ($id){
            $product->with(['subproducts'])->where('caterer_id', $id);
        }])->get();

        $menus = $menus->filter(function($menu){
            return count($menu->products) !=0;
        });

        $packages = Caterer::with(['packages' => function($package){
            $package->with('products');
        }])->find($id)->packages;

//        return $packages;

        foreach ($packages as $key => $package) {
            foreach($package->products as $key2 => $product)
                if($product->pivot->subproduct_id !== 0)
                    $packages[$key]->products[$key2]['subroduct'] = Subproduct::findOrFail($product->pivot->subproduct_id);
        }


//        return $packages;

        $caterer = Caterer::find($id);

        return response()->json(['menus' => $menus, 'caterer' => $caterer, 'packages' => $packages]);
    }
}
