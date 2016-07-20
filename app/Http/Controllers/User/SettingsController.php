<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\ZipCode;
use App\User;
use Validator, Hash;

class SettingsController extends UserBaseController
{
    
    public function getUpdate()
    {
        $user = $this->user->user()->toArray();
        $zips = ZipCode::all();
        
        return response()->json(['data' => $user, 'success' => 1]);
    }
    
    public function postUpdate(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'name' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'mobile' => 'required',

        ]);

       if(User::findOrFail($this->user->id()) -> update($request->all()))
           return redirect('user/account/view')->with('sucsess' ,'Your account updated successfully.');
        return back()->withErrors("Something went wrong can not update datas.");
            
    }
    
    
    public function getChangePassword()
    {
        return view('user/settings/changePassword',['role' => 'user']);
    }
    
    public function postChangePassword(Request $request)
    {
       $this->validate($request,[
                    'old_password' =>'required',
                    'password' => 'required|confirmed',
                    'password_confirmation' =>'required',
                ]);

        if(Hash::check($request->old_password, $this->user->user()->password))
        {
            User::findOrFail($this->user->id())->update( ['password' => bcrypt($request->password)]);
            return back()->with('success' , 'Password changed successfully.');
        }

        return back()->withErrors('Enter correct old password');



    }
    
}

