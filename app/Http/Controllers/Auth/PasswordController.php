<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Request;
use App\User;
use App\Models\Caterer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
     
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public  function checkEmailExists(Request $request)
    {
//        dd($request->all());
        $this->validate($request,['email' => 'required|email']);
        if($request->role == 'user'){
            if(!User::where(['email' =>$request->email, 'is_user' =>1])->first())
                return response()->json(['success' =>0, 'error' => 'Email does not exists.']);

            //namak@ gnac
            return response()->json(['success' => 1, 'message' => 'We sent a message to your email.Please check Your email and follow the link given in.']);
        }
        elseif($request->role == 'caterer'){
            if(Caterer::where('email',$request->email)->first())

                //namk@ gnac
                return response()->json(['success' => 1,'message' => 'We sent a message to your email.Please check Your email and follow the link given in.']);
            return response()->json(['success' =>0, 'error' => 'Email does not exists.']);
        }
    }

}
