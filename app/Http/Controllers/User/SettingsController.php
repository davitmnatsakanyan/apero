<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use Illuminate\Http\Request;
use App\Models\ZipCode;
use App\User;
use Hash;

class SettingsController extends UserBaseController
{

    public function getUpdate()
    {
        $user = $this->user->user()->with('user_zip')->first()->toArray();
        $zips = ZipCode::all();
       return response(['user' => $user, 'zips'=>$zips, 'success' => 1]);
    }

    public function postUpdate(Request $request)
    {
//        return  response()->json(['user' => $request->all() , 'success' => 1]);

        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|unique:users,email,' . $this->user->id() . ',id,is_user,1',
            'phone' => 'required',
            'mobile' => 'required',

        ]);

        if (User::findOrFail($this->user->id())->update($request->all()))
            return response()->json(['user' => $this->user->user()->toArray(), 'success' => 1]);
        return response()->json(['user' => $this->user->user()->toArray(), 'success' => 0]);

    }


    public function getChangePassword()
    {
        return view('user/settings/changePassword', ['role' => 'user']);
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (Hash::check($request->old_password, $this->user->user()->password)) {
            User::findOrFail($this->user->id())->update(['password' => bcrypt($request->password)]);
            return back()->with('success', 'Password changed successfully.');
        }

        return back()->withErrors('Enter correct old password');
    }

}

