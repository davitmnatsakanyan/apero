<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;
use App\Http\Services\CatererService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    private $user, $caterer;
    /**
     * Initializing registration data
     */
    public function __construct()
    {
        $this->user    = Auth::guard('user');
        $this->caterer = Auth::guard('caterer');
    }

    /**
    * Logining user
    */
   public function postLogin(LoginRequest $request)
   {
       $role = request()->get('role');
       if(!$this->$role->check())
        { 
           if( $this->$role->attempt(request()->except(['_token','role'])) )
            {
               return Response::json(1);
            }
            else 
            {
              return Response::json(0);
            }
        }
        else 
        {
            return Response::json(2);
        }
   }
   
   /**
    * Registering user
    */
   public function postRegister(RegisterRequest $request)
   {
        $role = strtolower(request()->get('role'));
        $roleService = ucfirst($role). "Service";
        $service = \App::make('App\Http\Services\\'.$roleService);
        $data = request()->except(['_token','role']);
        $data['password'] = bcrypt($data['password']);
        $model = $service->create($data);
        if($model)
        {
           $this->$role->attempt($model->getOriginal());
           return redirect($role . '/account')->with('success','Success registration');
        }
        return back()->withErrors('Something wet wrong,can not save data');
   }   
   
   
   public function getLogout($role)
   {
       $this->$role->logout();
       return redirect('home');
   }
   
}
