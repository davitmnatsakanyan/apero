<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
        return Response::json($this->caterer->user());
    }
    
   
}
