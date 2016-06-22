<?php

namespace App\Http\Middleware\Admin;

use Closure,Auth;


class AdminMiddleware
{
    protected  $admin;
    
    public function __construct() 
    {
       $this->admin = Auth::guard('admin');
    }
   
    public function handle($request, Closure $next, $guard = null)
    {
       if($this->admin->check())
        {
           return $next($request);
        }
        return redirect() -> back();
    }
}