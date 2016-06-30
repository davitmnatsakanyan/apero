<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Caterer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session,Image;

class CaterersController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $caterers = Caterer::paginate(15);

        return view('admin.caterers.index', compact('caterers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.caterers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, ['company' => 'required',
                                   'name' => 'required',
                                   'address' => 'required',
                                   'avatar' => 'required|image',
                                   'pobox' => 'required',
                                   'zip' => 'required',
                                   'city' => 'required',
                                   'email' => 'required|email|unique:caterers,email',
                                   'phone' => 'required',
                                   'mobile' => 'required',
                                   'country' => 'required',
                                   'description' => 'required',
                                   'products_origin' => 'required',
                                   'password' => 'required',
        ]);
        $caterer = $request->except(['_token','password']);
        $caterer['password'] = bcrypt($request->password);
        $caterer ['created_ip'] = $request->ip();
        $caterer['remember_token'] = $request->_token;
        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $caterer['avatar'] = time() . "." . $extension;
       if(Caterer::create($caterer)){
           $this->uploadFile($image,$caterer['avatar']);
          // return response()->json(['success' => true], 200);
           return redirect('admin/caterers')->with('success' ,'Caterer successfully added.');
       }

        else {
            return redirect('admin/caterers')->withErrors('Something went wrong.');
        }




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
        $caterer = Caterer::findOrFail($id);

        return view('admin.caterers.show', compact('caterer'));
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
        $caterer = Caterer::findOrFail($id);

        return view('admin.caterers.edit', compact('caterer'));
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
        $caterer = Caterer::findOrFail($id);
        $this->validate($request, ['company' => 'required',
                                   'name' => 'required',
                                   'address' => 'required',
                                   'pobox' => 'required',
                                   'zip' => 'required',
                                   'city' => 'required',
                                   'email' => 'required|email|unique:caterers,email,' . $caterer->id,
                                   'phone' => 'required',
                                   'mobile' => 'required',
                                   'country' => 'required',
                                   'description' => 'required',
                                   'products_origin' => 'required',
                                    'avatar' =>'image',
        ]);

        $caterer_update = $request->except(['password','_token','avatar']);

        if($request->password != NULL)
        {
            $caterer_update['password'] = $request->password;
        }

        if($request->avatar != NULL)
        {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $caterer['avatar'] = time() . "." . $extension;
        }
        
        if($caterer->update($caterer_update))
        {
            $this->uploadFile($image,$caterer_update['avatar'], true);
            Session::flash('flash_message', 'Caterer updated!');
            return redirect('admin/caterers');
        }
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
        $caterer = Caterer::withTrashed()->where('id', $id)->get();
        $avatar = $caterer[0]->avatar;
        unlink('images/caterers/' . $avatar);
        Caterer::withTrashed()->where('id', $id)->forceDelete();
        Session::flash('flash_message', 'Caterer deleted!');

        return redirect('admin/caterers');
    }


    public function block($id)
    {
        Caterer::destroy($id);

        Session::flash('flash_message', 'Caterer deleted!');

        return redirect('admin/caterers');
    }

    public function activate($id)
    {
        Caterer::withTrashed()->where('id', $id)->restore();
        return redirect('admin/caterers');
    }

    public function blockedCaterers()
    {
        $caterers = Caterer::onlyTrashed()->get();
        return view('admin.caterers.blocked', compact('caterers'));
    }

    public function uploadFile($image,$avatar, $old_image = null)
    {
        if(!is_null($old_image)){
            $file = 'images/products/' . $old_image;
            if(file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/caterers/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$avatar);
        return $avatar;
    }
}
