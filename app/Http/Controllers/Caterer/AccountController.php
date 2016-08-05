<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\Caterer;
use App\Models\ZipCode;

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
        $zip_codes = ZipCode::with('caterers')->get();
        $zip_codes = $zip_codes->filter(function($zip_code,$key){
            foreach($zip_code->caterers as $caterer)
                if($caterer->id == $this->caterer->id() )
                    return false;
            return true;
        });

//        dd($zip_codes->toArray(),$caterer->zips);

        return response()->json(['success' => 1,'caterer' => $caterer , 'zip_codes' => $zip_codes->toArray()]);
//        return view('caterer/layout/index');
    }


    
   
}
