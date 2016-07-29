<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth, View;


class UserBaseController extends Controller
{
    
    protected  $service;
    protected  $user;
    
    public function __construct() 
    {
        
        $this->user = auth('user');

        View::share('user', $this->user->user());
    }
}
