<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth, View;


class AdminBaseController extends Controller
{
    protected  $admin;
    
    public function __construct()
    {
        $this->admin = Auth::guard('admin');
        View::share('admin', $this->admin->user());
    }

    public function getAdminId()
    {
        return $this->admin->id();
    }
    
}



