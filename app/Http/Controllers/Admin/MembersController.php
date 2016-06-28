<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Session;

class MembersController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $members = User::paginate(15);

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'avatar' => 'image'
        ]);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar =  $this->uploadFile($file);

        }

        User::create([
            'company' => $request->company,
            'name' => $request->name,
            'avatar' => isset($avatar) ? $avatar : null,
            'address' => $request->address,
            'pobox' => $request->pobox,
            'zip' => $request->zip,
            'city' => $request->zip,
            'email' => $request->email,
            'country' => $request->country,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'created_ip' => $request->ip(),
            'remember_token' => $request->_token
        ]);

        Session::flash('flash_message', 'Member added!');

        return redirect('admin/members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $member = User::findOrFail($id);

        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $member = User::findOrFail($id);

        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $member = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|unique:users,email,'.$member->id,
            'phone' => 'required',
            'mobile' => 'required',
            'avatar' => 'image'
        ]);


        $member->update([
            'name' => $request->name,
            'company' => $request->company,
            'address' => $request->address,
            'pobox' => $request->pobox,
            'zip' => $request->zip,
            'city' => $request->city,
            'country' => $request->country,
            'email' =>$request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
        ]);
        if(!is_null($request->password)){
            $member->update(['password' => $request->password]);
        }
        if(!is_null($request->file('avatar'))){

            $oldImage = $member->avatar;
            $avatar = $this->uploadFile($request->file('avatar'), $oldImage);

            $member->update(['avatar' => $avatar]);
        }

        Session::flash('flash_message', 'Member updated!');

        return redirect('admin/members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        unlink('images/users/'.User::find($id)->avatar);
        User::destroy($id);

        Session::flash('flash_message', 'Member deleted!');

        return redirect('admin/members');
    }

    /**
     * @param $image
     * @param null $oldImage
     * @return string
     */
    public  function uploadFile($image, $oldImage = null){
        if(!is_null($oldImage)){
            unlink('images/users/'.$oldImage);
        }
        $destinationPath = 'images/users';
        $extension = $image->getClientOriginalExtension();
        $avatar = time() . '.' . $extension;
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$avatar);
        return $avatar;
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getBlock($user_id){
        User::destroy($user_id);
        return redirect()->back();
    }
}
