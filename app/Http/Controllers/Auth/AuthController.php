<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;
use App\Http\Services\CatererService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    private $user, $caterer, $catererService;
    /**
     * Initializing registration data
     */
    public function __construct(CatererService $catererService)
    {
        $this->user    = Auth::guard('user');
        $this->caterer = Auth::guard('caterer');
        $this->catererService = $catererService;
    }

    public  function getRegister(){
        $zipCode = array();
        $data=array();
        $data['zip_codes'] = array();
        $zip_codes = $this->catererService->zipCodes();
            foreach($zip_codes as $zip_code){
                $zipCode['id'] = $zip_code['id'];
                $zipCode['zip'] = $zip_code['ZIP'];
                $zipCode['text'] = $zip_code['ZIP'].' '.$zip_code['city'];
                array_push($data['zip_codes'], $zipCode );
            }
        $data['categories'] = $this->catererService->foodCategories();
        return $data;
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
        $role = strtolower($request->role);
        $roleService = ucfirst($role). "Service";
        $service = \App::make('App\Http\Services\\'.$roleService);
        $data = $request->except(['_token','role']);
        $password = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $model = $service->create($data);
        if($model)
        {
           if($this->$role->attempt(['email' => $model->email, 'password' => $password]))
               return response()->json(['success' => 1, 'caterer' => $model]);
           else
               return response()->json(['success' => 0]);
        }
       return response()->json(['success' => 2]);
   }   
   
   
   public function getLogout($role)
   {
       $this->$role->logout();
       return redirect('home');
   }

    public function getCheck(){
       if($this->caterer->check()){
           return response()->json(['success' => 1]);
       }
        else{
            return response()->json(['success' => 0]);
        }
    }
   
}
