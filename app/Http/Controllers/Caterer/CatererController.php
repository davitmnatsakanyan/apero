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
        $kitchens = Kitchen::with(['menus' => function ($menu) use ($id) {
            $menu->with(['products' => function ($product) use ($id) {
                $product->where('caterer_id', $id);
            }]);
        }])->get()->filter(function ($kitchen) {
            $flag = false;
            if (count($kitchen->menus) > 0)
                foreach ($kitchen->menus as $menu)
                    if (count($menu->products) > 0)
                        $flag = true;

            return $flag;
        });

        $menus = array();
        foreach($kitchens->toArray() as $kitchen){
            foreach($kitchen['menus'] as $menu){
                $menus[] = $menu;
            }
        }

        $caterer = Caterer::find($id);

        return response()->json(['menus' => $menus, 'caterer' => $caterer]);
    }
}
