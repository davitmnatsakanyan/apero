<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ZipCode;
use App\Models\Country;
use App\Models\Admin;
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
        $members = User::where('is_user', 1)->paginate(15);

        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $zips = ZipCode::all();
        $countries = Country::all();
        return view('admin.members.create', compact('zips','countries'));
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
            'title' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,is_user,1',
            'phone' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'fax' =>'required',

            
        ]);
        
        User::create([
            'name' => $request->name,
            'title' => $request->title,
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
            'is_user' => 1,
            'remember_token' => $request->_token
        ]);

        Session::flash('flash_message', 'Member added!');

        return redirect('admin/members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function show($id)
    {
        $member = User::with('user_zip')->where('is_user', 1)->findOrFail($id);

        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return void
     */
    public function edit($id)
    {
        $member = User::where('is_user', 1)->findOrFail($id);
        $zips = ZipCode::all();
        $countries = Country::all();

        return view('admin.members.edit', compact('member', 'zips','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $member = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|unique:users,email,' . $member->id . ',id,is_user,1',
            'phone' => 'required',
            'mobile' => 'required',
        ]);

        $member->update([
            'name' => $request->name,
            'title' => $request->title,
            'address' => $request->address,
            'pobox' => $request->pobox,
            'zip' => $request->zip,
            'city' => $request->city,
            'country' => $request->country,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'fax' => $request->fax,
        ]);
        if (!is_null($request->password)) {
            $member->update(['password' => bcrypt($request->password)]);
        }
        Session::flash('success', 'User updated!');

        return redirect('admin/members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::withTrashed()->where(['is_user' => 1, 'id' => $id])->forceDelete();

        Session::flash('success', 'User deleted!');

        return redirect('admin/members');
    }

    /**
     * @param $image
     * @param null $oldImage
     * @return string
     */

    /**
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id)
    {
        $user = User::findOrfail($id);
        if ($user->is_user)
            if (User::destroy($id)) {
                $user->update(['admin_id' => $this->admin->id()]);
                return redirect('admin/members')->with('success', 'User successfully blocked.');
            }
        return redirect()->back()->with('error', 'Something went wrong');
    }


    public function getBlocked()
    {
        $members = User::onlyTrashed()->paginate(15);
        foreach($members as $member)
            $member->admin = Admin::findOrFail($member->admin_id)->name;
        return view('admin/members/blocked', compact('members'));
    }

    public function activate($id)
    {
        if (User::withTrashed()->where('is_user', 1)->findOrFail($id)->restore())
            return redirect('admin/members')->with('success', 'User successfully activated.');
        return back()->with('error', 'Somethong went wrong');
    }
}
