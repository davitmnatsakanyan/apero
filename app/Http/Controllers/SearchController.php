<?php

namespace App\Http\Controllers;

use App\Models\Caterer;
use App\Models\Kitchen;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public  function getCaterers(){
        $caterers = Caterer::with('kitchens')->get();
        $kitchens = Kitchen::all();
//        $kitchens = [
//            0 => ['name' => 'Ararat'],
//            1 => ['name' => 'dfgdfg'],
//        ];
        return response()->json(['caterers' => $caterers, 'kitchens' => $kitchens]);
    }
}
