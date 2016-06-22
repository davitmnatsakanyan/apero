<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;
use Validator;

class SettingsController extends UserBaseController
{
    
    public function getUpdate()
    {
        return view('user/settings/update');
    }
    
    public function postUpdate(UserService $userService)
    {
        $update = $userService->updateById( request()->get('id'), request()->except(['_token'.'id']));
        if( $update)
           return redirect('user/account');
        return back()->withErrors("Something went wrong can not update datas.");
            
    }
    
    
    public function getChangePassword()
    {
        return view('user/settings/changePassword',['role' => 'user']);
    }
    
    public function postChangePassword(UserService $userService)
    {
        $val=Validator::make(request()->except('_token'),
                [
                    'password' => 'required|confirmed',
                    'password_confirmation' =>'required',
                ]);
        
         if(!$val->fails())
        {
            $user_id   = $this->user->user()->id;
            $new_password = bcrypt(request()->get('password'));
            $update = $userService->updateById( $user_id, ['password' => $new_password]);
            
            if($update)
              return redirect('user/account')->with('message' , 'Your password sucsessfuly changed');
            return back()->withErrors("Something went wrong can not change password.");
        }
        return redirect()->back()->withErrors($val);
        
        
    }
    
}

