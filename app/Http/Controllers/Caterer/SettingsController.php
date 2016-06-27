<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\CatererService;
use Validator;

class SettingsController extends CatererBaseController
{
    
    public function getUpdate()
    {
        return view('caterer/settings/update');
    }
    
    public function postUpdate(CatererService $catererService)
    {
        $update = $catererService->updateById( request()->get('id'), request()->except(['_token'.'id']));
        if( $update)
           return redirect('caterer/account');
        return back()->withErrors("Something went wrong can not update datas.");
            
    }
    
    
    public function getChangePassword()
    {
        return view('caterer/settings/changePassword',['role' => 'caterer']);
    }
    
    public function postChangePassword(CatererService $catererService)
    {
        $val=Validator::make(request()->except('_token'),
                [
                    'password' => 'required|confirmed',
                    'password_confirmation' =>'required',
                ]);
        
         if(!$val->fails())
        {
            $caterer_id   = $this->caterer->user()->id;
            $new_password = bcrypt(request()->get('password'));
            $update = $catererService->updateById( $caterer_id, ['password' => $new_password]);
            
            if($update)
              return redirect('caterer/account')->with('message' , 'Your password sucsessfuly changed');
            return back()->withErrors("Something went wrong can not change password.");
        }
        return redirect()->back()->withErrors($val);
        
        
    }
    
}
