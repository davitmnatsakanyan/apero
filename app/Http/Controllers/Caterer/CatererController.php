<?php

namespace App\Http\Controllers\Caterer;

use App\Models\Caterer;
use App\Models\Kitchen;
use App\Models\Menu;
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
        
        $caterer = Caterer::find($id);

        return response()->json(['menus' => $menus, 'caterer' => $caterer]);
    }
}
