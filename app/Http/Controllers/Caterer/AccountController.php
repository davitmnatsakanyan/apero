<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Caterer;

class AccountController extends CatererBaseController
{
    /**
     * Show Dashboard default page
     * 
     * @return view
     */

    protected  $caterer;

    public function getIndex()
    {
        $caterer = Caterer::with(['kitchens' ,'zips' ,'cookingtime','contact_person'])->findOrFail($this->caterer->id());
        return response()->json(['success' => 1,'caterer' => $caterer]);
//        return view('caterer/layout/index');
    }


    
   
}
