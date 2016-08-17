<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;
use App\Http\Services\CatererService;
use App\Models\Caterer;
use App\Models\Country;
use App\User;
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
        $zipCode = [];
        $data=[];
        $data['zip_codes'] = [];
        $zip_codes = $this->catererService->zipCodes();
            foreach($zip_codes as $zip_code){
                $zipCode['id'] = $zip_code['id'];
                $zipCode['zip'] = $zip_code['ZIP'];
                $zipCode['text'] = $zip_code['ZIP'].' '.$zip_code['city'];
                array_push($data['zip_codes'], $zipCode );
            }
        $data['categories'] = $this->catererService->foodCategories();
        $data['countries'] = Country::all();
        return $data;
    }

    /**
    * Logining user
    */
   public function postLogin(Request $request)
   {
       $role = $request->role;
       if(!$this->$role->check())
        {
            if($role == 'user')
                $attempt = $this->$role->attempt(['email' => $request->email, 'password' => $request->password, 'is_user' => 1]);

            if($role == 'caterer')
                $attempt = $this->$role->attempt(['email' => $request->email, 'password' => $request->password]);

           if( $attempt )
            {
                session(['role' => $role]);
               return response()->json(['success' => 1]);
            }
            else 
            {
              return response()->json(['success' => 0]);
            }
        }
        else 
        {
            return response()->json(['success' => 2]);
        }
   }
   
   /**
    * Registering user
    */
   public function postRegister(Request $request)
   {

//       dd($request->zip);
       if($request->role == 'user'){
           $this->validate($request, [
               'address'            => 'required|max:250',
               'pobox'              => 'required|max:100',
               'zip'                => 'required|max:5',
               'city'               => 'required|max:250',
               'country'            => 'required|max:3',
               'email'              => 'required|email|max:100|unique:users',
               'phone'              => 'required|max:50',
               'password'           => 'required|confirmed',
               'password_confirmation'  => 'required',
               'fax'                => 'required',
               'name'               => 'required',
               'title'              => 'required',
               'mobile'             => 'required'
           ]);
       }
        $role = strtolower($request->role);
        $roleService = ucfirst($role). "Service";
        $service = \App::make('App\Http\Services\\'.$roleService);
        $data = $request->except(['_token','role']);
        $password = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['created_ip'] = $request->ip();
        $data['is_user'] = 1;
        $model = $service->create($data);

        if($model)
        {
            if($role == 'user') {
                $attempt = $this->$role->attempt(['email' => $model->email, 'password' => $password, 'is_user' => 1]);
            }

            if($role == 'caterer')
                $attempt = $this->$role->attempt(['email' => $model->email, 'password' => $password]);

            if($attempt) {
               session(['role' => $role]);
               return response()->json(['success' => 1]);
           }
           else {
               return response()->json(['success' => 0]);
           }
        }
       return response()->json(['success' => 2]);
   }   
   
   
   public function getLogout()
   {
       $role = session('role');
       session()->forget('role');
       $this->$role->logout();
       return response()->json(['success' => 1]);
}

    public function getCheck($role){

       if($this->$role->check()){
           return response()->json(['success' => 1]);
       }
        else{
            return response()->json(['success' => 0]);
        }
    }

    public function getLogedin(){
       if($this->caterer->check() || $this->user->check()){
           $role = $this->user->check()?'user':'caterer';
           return response()->json(['success' => 1,'role' => $role]);
       }
        else{
            return response()->json(['success' => 0]);
        }
    }

    public function getIsEmailUnique(Request $request){
       $count = Caterer::where('email', $request->email)->get()->count();
        if($count > 0)
            return response()->json('false');
        else
            return response()->json('true');
    }
   
}
