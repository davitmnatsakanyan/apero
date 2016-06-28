<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Admin\AdminBaseController;
use DB;

class AdminController extends AdminBaseController
{


    /**
     *  Load defoult page
     *
     * @return redirct|view
     */
    public function getIndex()
    {
        if ($this->admin->check()) {
            return redirect('admin/dashboard');
        }

        return redirect('admin/login');
    }

    public function getLogin()
    {
        if (!$this->admin->check()) {
            return view('admin/login');
        }
        return redirect()->back();
    }


    /**
     * Log in admin
     *
     * @return redirect
     */

    public function postLogin(LoginRequest $request)
    {

        if ($this->admin->attempt(request()->except('_token'))) {

            return redirect('admin/dashboard');

        } else {
            return redirect()->back()->withErrors(['error' => 'Incorrect admin login or password']);
        }
    }


    /**
     *  Log out admin
     *
     * @return redirect
     */

    public function getLogout()
    {

        if ($this->admin->check()) {
            $this->admin->logout();
            return redirect('admin/login');
        }

        return back();
    }
}
