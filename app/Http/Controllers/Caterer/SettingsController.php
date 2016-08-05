<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\CatererService;
use Illuminate\Http\Request;
use App\Models\Caterer;
use App\Models\CatererDeliveryArea;
use App\Models\ContactPerson;
use App\Models\DeliveryArea;
use App\Models\CookingTime;
use App\Models\ZipCode;
use Validator, Image, Hash;


class SettingsController extends CatererBaseController
{

    public function getUpdate()
    {
        $my_caterer = $this->caterer->user();
        $contact_person = ContactPerson::where('caterer_id', $this->caterer->id())->first();
        $zips = ZipCode::all();

        $my_caterer ['cp_name'] = $contact_person['name'];
        $my_caterer ['cp_title'] = $contact_person ['title'];
        $my_caterer ['cp_prename'] = $contact_person ['prename'];
        $my_caterer ['cp_phone'] = $contact_person ['phone'];
        $my_caterer ['cp_mobile'] = $contact_person ['mobile'];
        $my_caterer ['cp_email'] = $contact_person ['email'];

        return view('caterer/settings/update', compact('my_caterer', 'zips'));
    }


    public function postUpdate(CatererService $catererService)
    {
        $this->validate(request(), [
            'company' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'fax' => 'required',
            'description' => 'required',

            'cp_title' => 'required',
            'cp_name' => 'required',
            'cp_prename' => 'required',
            'cp_mobile' => 'required',
            'cp_phone' => 'required',
            'cp_email' => 'required|email',
        ]);

        $optional = request()->except(['cp_title', 'cp_name', 'cp_prename', 'cp_mobile', 'cp_phone', 'cp_email', '_token']);
        $optional['rememberd_token'] = request()->_token;


        Caterer::findOrFail($this->caterer->id())->update($optional);

        $contact_person['title'] = request()->cp_title;
        $contact_person['name'] = request()->cp_name;
        $contact_person['prename'] = request()->cp_prename;
        $contact_person['phone'] = request()->phone;
        $contact_person['mobile'] = request()->mobile;
        $contact_person['email'] = request()->email;

        ContactPerson::where('caterer_id', $this->caterer->id())->update($contact_person);

        return redirect('caterer/account')->with('success', 'Your information updated.');

    }


    public function updateContactPerson(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'prename' => 'required',
            'mobile' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);


        if (ContactPerson::where('caterer_id', $this->caterer->id())->update($request->all()))
            return response()->json(['success' => 1, 'message' => 'Your contact person information updated.']);

        return response()->json(['success' => 0, 'error' => 'Somethnig went wrong.']);

    }


    public function getDeliveryArea()
    {

        $delivery_areas = Caterer::with('zips')->find($this->caterer->id())->zips;
        $zip_codes = ZipCode::with('caterers')->get();
        $zip_codes = $zip_codes->filter(function ($zip_code, $key) {
            foreach ($zip_code->caterers as $caterer)
                if ($caterer->id == $this->caterer->id())
                    return false;
            return true;
        });

        return view('caterer/settings/deliveryArea', compact('delivery_areas', 'zip_codes'));
    }


    public function getChangePassword()
    {
        return view('caterer/settings/changePassword', ['role' => 'caterer']);
    }


    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);


        if (Hash::check($request->old_password, $this->caterer->user()->password)) {
            Caterer::findOrFail($this->caterer->id())->update(['password' => bcrypt($request->password)]);
            return back()->with('success', 'Password changed successfully.');
        }

        return back()->withErrors('Enter correct old password');

    }


    public function addDeliveryArea(Request $request)
    {
        if (empty($request->all()))
            return response()->json(['success' => 0, 'error' => 'Please select zip code.']);

        foreach ($request->all() as $zip_code)
            CatererDeliveryArea::create(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $zip_code['id']]);

        return response()->json(['success' => 1, 'message' => 'Zip codes added successfully.']);
    }


    public function removeDeliveryArea($id)
    {
        if (CatererDeliveryArea::where(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $id])->delete()) {
            $zips = Caterer::with('zips')->findOrFail($this->caterer->id())->zips;
            return response()->json(['success' => 1, 'message' => 'Delivery area successfully deleted.', 'zips' => $zips]);
        }
        return response()->json(['success' => 0, 'message' => 'Something went wrong.']);
    }


    public function updateAvatar(Request $request)
    {
        $tempDir = __DIR__ . DIRECTORY_SEPARATOR . 'temp';
        return $request->all();
        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }
        $chunkDir = $tempDir . DIRECTORY_SEPARATOR . $request->flowIdentifier;
        $chunkFile = $chunkDir . '/chunk.part' . $request->flowChunkNumber;
        if (file_exists($chunkFile)) {
            dd(12);
            header("HTTP/1.0 200 Ok");
        } else {
            dd(22);
            header("HTTP/1.0 404 Not Found");
        }

        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        $new_avatar = time() . "." . $extension;
        $old_image = $this->caterer->user()->avatar;

        if ($old_image != "") {
            $file = 'images/caterers/' . $old_image;
            if (file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/caterers/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $new_avatar);

        return response()->json(['success' => 1, 'message' => 'Avatar successfully updated.']);

    }

    public function editCookingTime(Request $request)
    {
        $this->validate($request, [
            'group' => 'required',
            'time' => 'required'
        ]);

        if (CookingTime::where(['caterer_id' => $this->caterer->id()])->update([$request->group => $request->time]))
            return response()->json(['success' => 1, 'message' => 'Cooking time successfully updated.']);
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

    }

}
