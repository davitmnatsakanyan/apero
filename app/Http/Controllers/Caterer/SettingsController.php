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
use App\Models\CatererKitchen;
use Validator, Image, Hash;
use Flow\Config;

class SettingsController extends CatererBaseController
{

    public $destination_path;
    public $config;

    public function postUpdate(Request $request)
    {
        $this->validate($request, [
            'company' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:caterers,email,'.$this->caterer->id() ,
            'phone' => 'required',
            'fax' => 'required',
            'description' => 'required',
            'products_origin' =>'required'
            ]);
       if( Caterer::findOrFail($this->caterer->id())->update($request->all()))
            return response()->json(['success' => 1, 'message' => 'Your common information updated.']);
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

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

        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

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


    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);


        if (Hash::check($request->old_password, $this->caterer->user()->password)) {
            Caterer::findOrFail($this->caterer->id())->update(['password' => bcrypt($request->password)]);
            return response()->json(['success' => 1, 'message' => 'password successfully changed.']);
        }

        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);

    }


    public function addDeliveryArea(Request $request)
    {
        if (empty($request->all()))
            return response()->json(['success' => 0, 'error' => 'Please select zip code.']);

        foreach ($request->all() as $zip_code)
            CatererDeliveryArea::create(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $zip_code['id']]);

        return response()->json(['success' => 1, 'message' => 'Zip codes added successfully.']);
    }

    public function addKitchen(Request $request)
    {
        if (empty($request->all()))
            return response()->json(['success' => 0, 'error' => 'Please select kitchen.']);

        foreach ($request->all() as $kitchen)
            CatererKitchen::create(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $kitchen['id']]);

        return response()->json(['success' => 1, 'message' => 'Kitchens added successfully.']);
    }

    public function removeKitchen($id)
    {
        if (CatererKitchen::where(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $id])->delete()) {
            Product::where(['caterer_id' => $this->caterer->id(), 'kitchen_id' => $id])->forceDelete();
            return response()->json(['success' => 1, 'message' => 'Kitchen successfully deleted.']);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
    }


    public function removeDeliveryArea($id)
    {
        if (CatererDeliveryArea::where(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $id])->delete()) {
            $zips = Caterer::with('zips')->findOrFail($this->caterer->id())->zips;
            return response()->json(['success' => 1, 'message' => 'Delivery area successfully deleted.', 'zips' => $zips]);
        }
        return response()->json(['success' => 0, 'error' => 'Something went wrong.']);
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


    public function uploadFile(Request $request)
    {
        try {

            $this->config = new Config(['tempDir' => public_path('temp')]);

            $flowRequest = new \Flow\Request();

            if (\Flow\Basic::save(
                public_path($this->getImagePublicDestinationPath($request)) . '/' . $request->input('flowFilename'), $this->config, $flowRequest)
            ) {
                Caterer::findOrFail($this->caterer->id())->update(['avatar' => $request->input('flowFilename')]);
                return response(['message' => "File Uploaded {$request->input('flowFilename')}"], 200);
            } else {
                return response([], 204);
            }
        } catch (\Exception $e) {
            throw new \Exception(sprintf("Error saving image %s", $e->getMessage()));
        }
    }

    public function getImagePublicDestinationPath(Request $request)
    {
        return ($request->input('path')) ? $request->input('path') : 'images';
    }

}
