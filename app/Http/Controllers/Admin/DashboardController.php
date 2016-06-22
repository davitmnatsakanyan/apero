<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminBaseController;

class DashboardController extends AdminBaseController
{
    /**
     * Show Dashboard default page
     * 
     * @return view
     */
    public function getIndex()
    {
        return view('admin/dashboard/index');
    }
    
   
}
