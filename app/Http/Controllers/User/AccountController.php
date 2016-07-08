<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Services\UserService;
use App\Models\ZipCode;

class AccountController extends UserBaseController
{
    /**
     * Show Dashboard default page
     * 
     * @return view
     */
    public function getIndex()
    {
        
        return view('user/account/index');
    }
    
    public function getView()
    {
        $zips = ZipCode::findOrFail($this->user->user()->zip);
        $zip['ZIP'] = $zips->ZIP;
        $zip['city'] = $zips->city;

        return view('user/account/view',compact('zip'));
    }
    
}
