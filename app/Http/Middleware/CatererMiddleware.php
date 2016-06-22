<?php

namespace App\Http\Middleware;

use Closure,Auth;


class CatererMiddleware
{
    protected  $caterer;
    
    public function __construct() 
    {
       $this->caterer = Auth::guard('caterer');
    }
   
    public function handle($request, Closure $next, $guard = null)
    {
       if($this->caterer->check())
        {
           return $next($request);
        }
        return redirect() -> back();
    }
}

