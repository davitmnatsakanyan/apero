<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Carbon\Carbon;

class UserManagmentController extends AdminBaseController
{
    public function getIndex(UserService $service)
    {
       return view('admin/user_managment/index',['users' =>  $service->getAll()->all()]);
    }
    
    public function getView(UserService $service, $id)
    {
       return view('admin/user_managment/view',['user' => $service->getById($id)->getOriginal()]);
    }
    
    public function getEdit(UserService $service, $id)
    {
       return view('admin/user_managment/edit',['user' => $service->getById($id)->getOriginal()]);
    }
    
    public function postEdit(UserService $service)
    {
        $user = request()->except(['_token','id','password']);
        $user['password'] = bcrypt(request()->get('password'));
        $update = $service->updateById( request()->get('id'), $user);
        if( $update)
           return redirect('admin/user');
        return back()->withErrors("Something went wrong can not update datas.");
    }
    
    public function getDelete(UserService $service,$id)
    {
         $data=[];
         $data['deleted'] = 1;
         $data['deleter_id'] = $this->admin->id();
         $data['deleted_time'] = Carbon::now();
         $update = $service->updateById( $id, $data);
         if($update)
            return  redirect()->back()->with('message' , 'User successfuly deleted');
         else 
             return redirect()->back() -> withErrors('Something whent wrong');
             
    }
    
    public function getActivate(UserService $service,$id)
    {
         $data=[];
         $data['deleted'] = 0;
         $data['deleter_id'] = Null;
         $data['deleted_time'] = Null;
         $update = $service->updateById( $id, $data);
         if($update)
            return  redirect()->back()->with('message' , 'User successfuly deleted');
         else 
             return redirect()->back() -> withErrors('Something whent wrong');
             
    }
}
