<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth,View;

class HomeController extends Controller
{
    protected  $user;
    protected  $caterer;
    
    public function __construct() 
    {
        $this->user = Auth::guard('user');
        $this->caterer = Auth::guard('caterer');
        if($this->user->check())
        {
            View::share('user',$this->user);
        }
         if($this->caterer->check())
         {
            View::share('caterer',$this->caterer);
         }
    }
    
    public function getIndex()
    {
        return view('index');
    }
  
}

