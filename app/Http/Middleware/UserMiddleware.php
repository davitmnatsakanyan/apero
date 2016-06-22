<?php

namespace App\Http\Middleware;

use Closure,Auth;


class UserMiddleware
{
    protected  $user;
    
    public function __construct() 
    {
       $this->user = Auth::guard('user');
    }
   
    public function handle($request, Closure $next, $guard = null)
    {
       if($this->user->check())
        {
           return $next($request);
        }
        return redirect() -> back();
    }
}
