<?php

namespace App\Http\Controllers;

use App\Models\Caterer;
use App\Models\Kitchen;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public  function getCaterers(Request $request){
        if(count($request->all()) > 0){

            $caterers = Caterer::with('kitchens', 'zips')->get();
            $filtered = $caterers->filter(function($item) use ($request){
                foreach ($item->zips as $zip){
                    if($zip->city == $request->city){
                        return $item;
                    }
                }
            });

            $caterers =  $filtered->values()->all();

            foreach ($caterers as $caterer){
                
            }
        }
        else {
            $caterers = Caterer::with('kitchens')->get();
        }

        $kitchens = Kitchen::all();
        return response()->json(['caterers' => $caterers, 'kitchens' => $kitchens]);
    }
}
