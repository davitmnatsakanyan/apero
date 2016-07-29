<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\CookingTime;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ContactPerson;
use App\Models\Caterer;
use App\Models\ZipCode;
use App\Models\CatererDeliveryArea;
use App\Models\CatererKitchen;
use App\Models\Kitchen;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session, Image;

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
        $zips = ZipCode::all();
        return view('admin.caterers.create' , compact('zips') );
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
        $caterer = $request->except(['_token', 'password']);
        $caterer['password'] = bcrypt($request->password);
        $caterer ['created_ip'] = $request->ip();
        $caterer['remember_token'] = $request->_token;
        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $caterer['avatar'] = time() . "." . $extension;
        if (Caterer::create($caterer)) {
            $this->uploadFile($image, $caterer['avatar']);
            // return response()->json(['success' => true], 200);
            return redirect('admin/caterers')->with('success', 'Caterer successfully added.');
        } else {
            return redirect('admin/caterers')->withErrors('Something went wrong.');
        }


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
        $caterer = Caterer::with('zips')->findOrFail($id);
        $contact_person = ContactPerson::where('caterer_id', $id)->first();

        return view('admin.caterers.show', compact('caterer', 'contact_person'));
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

        $caterer = Caterer::with('contact_person', 'zips', 'kitchens' ,'cookingtime')->findOrFail($id);

//        return $caterer->cookingtime;
        
        $kitchens = CatererKitchen::where('caterer_id', $id)->lists('kitchen_id');

        $adding_kitchens = Kitchen::whereNotIn('id', $kitchens)->get();
        $zips = ZipCode::with('caterers')->get();
        $zip_codes = $zips->filter(function ($zip_code, $key) use ($caterer) {
            foreach ($zip_code->caterers as $caterer1)
                if ($caterer1->id == $caterer->id)
                    return false;
            return true;
        });

//        return $caterer;

        return view('admin.caterers.edit', compact('caterer', 'zip_codes','zips','adding_kitchens'));
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
        switch ($request->edit) {
            case 'ci_edit' :
                return $this->common_informtion_update($id, $request);
            case 'cp_edit' :
                return $this->contact_person_update($id, $request);
        }


    }


    public function common_informtion_update($id, $request)
    {
        $caterer = Caterer::findOrFail($id);
        $this->validate($request, ['company' => 'required',
            'address' => 'required',
            'pobox' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'email' => 'required|email|unique:caterers,email,' . $caterer->id,
            'phone' => 'required',
            'country' => 'required',
            'description' => 'required',
            'products_origin' => 'required',
            'avatar' => 'image',
        ]);

        $caterer_update = $request->except(['password', '_token', 'avatar']);

        if ($request->password != NULL) {
            $caterer_update['password'] = $request->password;
        }

        if ($request->avatar != NULL) {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $caterer['avatar'] = time() . "." . $extension;
            $this->uploadFile($image, $caterer_update['avatar'], true);
        }

        if ($caterer->update($caterer_update)) {
            Session::flash('flash_message', 'Caterer updated!');
            return redirect('admin/caterers');
        }

    }


    public function contact_person_update($id, $request)
    {
        $this->validate($request, [
            'cp_title' => 'required',
            'cp_prename' => 'required',
            'cp_name' => 'required',
            'cp_email' => 'required|email',
            'cp_phone' => 'required',
            'cp_mobile' => 'required',
        ]);

        $data['title'] = $request->cp_title;
        $data['prename'] = $request->cp_prename;
        $data['name'] = $request->cp_name;
        $data['email'] = $request->cp_email;
        $data['phone'] = $request->cp_phone;
        $data['mobile'] = $request->cp_mobile;

        if (ContactPerson::where('caterer_id', $id)->update($data))
            return back()->with('success', 'Contact person updated successfully');
        return back()->with('error', 'Something went wrong');
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

    public function uploadFile($image, $avatar, $old_image = null)
    {
        if (!is_null($old_image)) {
            $file = 'images/products/' . $old_image;
            if (file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/caterers/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }


    public function addDeliveyArea(Request $request)
    {
        $this->validate($request,['zip_codes' => 'required']);

        foreach(request()->zip_codes as $zip_code)
            CatererDeliveryArea::create(['caterer_id' => $request->caterer_id, 'zip_code_id' => $zip_code]);

        return back()->with('success' , 'Zip code added successfully');
    }

    public function removeZipFromDeliveryArea($caterer_id ,$zip_id)
    {

        if(CatererDeliveryArea::where(['caterer_id' => $caterer_id, 'zip_code_id' => $zip_id])->delete())
            return back()->with('success','Delivery area successfully deleted.');
        return back()->withErrors('Something went wrong.');
    }


    public function addKitchen(Request $request)
    {
        $this->validate($request, ['kitchen' => 'required']);
        foreach ($request->kitchen as $kitchen_id)
            CatererKitchen::create(['caterer_id' => $request->caterer_id, 'kitchen_id' => $kitchen_id]);
        return back()->with('success', 'Kitchen add sucessfully');
    }
    
    public function removeKitchen($caterer_id ,$kitchen_id)
    {
        $avatars = Product::where(['kitchen_id' => $kitchen_id, 'caterer_id' => $caterer_id])->lists('avatar');

        $avatars = array_where($avatars, function ($key, $value) {
            return $value !== "";
        });

        Product::where(['caterer_id' => $caterer_id, 'kitchen_id' => $kitchen_id])->forceDelete();

        foreach ($avatars as $avatar)
            if (file_exists('images/products/' . $avatar))
                unlink('images/products/' . $avatar);

        if (CatererKitchen::where(['caterer_id' => $caterer_id, 'kitchen_id' => $kitchen_id])->delete())
            return back()->with('success', 'Kitcehn succsessfully deleted.');



        return back()->withErrors('Something went wrong.');

    }


    public function editCookingTime(Request $request)
    {
        CookingTime::where(['caterer_id' => $request->caterer_id ])->update([ $request->group => $request->time ]);
        return back()->with('success', 'Cooking time changes successfully.');
    }
}
