<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Controller;
use Auth, View;


class CatererBaseController extends Controller
{
    
    protected  $caterer;
    
    public function __construct() 
    {
        $this->caterer = Auth::guard('caterer');
        View::share('caterer', $this->caterer->user());
    }
}

