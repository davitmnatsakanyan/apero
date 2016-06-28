<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminBaseController;
use App\User;

class DashboardController extends AdminBaseController
{
    /**
     * Show Dashboard default page
     * 
     * @return view
     */
    public function getIndex()
    {
        $total_users = count(User::all());
        return view('admin/dashboard/index', compact('total_users'));
    }
    
   
}
