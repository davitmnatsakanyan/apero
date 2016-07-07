<?php
namespace App\Http\Controllers\Caterer;

use App\Http\Controllers\Caterer\CatererBaseController;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\CatererService;
use App\Models\Caterer;
use App\Models\CatererDeliveryArea;
use App\Models\ContactPerson;
use App\Models\DeliveryArea;
use App\Models\ZipCode;
use Validator,Image;


class SettingsController extends CatererBaseController
{
    
    public function getUpdate()
    {
        $my_caterer = $this->caterer->user();
        $contact_person = ContactPerson::where('caterer_id' ,$this->caterer->id())->first();
        $zips = ZipCode::all();

        $my_caterer ['cp_name'] = $contact_person['name'];
        $my_caterer ['cp_title'] = $contact_person ['title'];
        $my_caterer ['cp_prename'] = $contact_person ['prename'];
        $my_caterer ['cp_phone'] = $contact_person ['phone'];
        $my_caterer ['cp_mobile'] = $contact_person ['mobile'];
        $my_caterer ['cp_email'] = $contact_person ['email'];

        return view('caterer/settings/update', compact('my_caterer','zips'));
    }
    
    public function postUpdate(CatererService $catererService)
    {
        $this->validate(request(),[
            'avatar' =>'image',
            'company' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' =>'required',
            'email' => 'required|email',
            'phone' => 'required',
            'fax' => 'required',
            'description' => 'required',

            'cp_title' => 'required',
            'cp_name' => 'required',
            'cp_prename' =>'required',
            'cp_mobile' =>'required',
            'cp_phone' =>'required',
            'cp_email' => 'required|email',
        ]);

        $optional = request()->except(['cp_title', 'cp_name', 'cp_prename', 'cp_mobile','cp_phone', 'cp_email','_token','avatar']);
        $optional['rememberd_token'] = request()->_token;

        if(!is_null(request()->avatar))
        {
            $image = request()->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $optional['avatar'] = time() . "." . $extension;
            $old_avatar = $this->caterer->user()->avatar;
            $this->uploadFile($image,$optional['avatar'],$old_avatar);
        }


        Caterer::findOrFail($this->caterer->id())->update( $optional);

        $contact_person['title'] = request()->cp_title;
        $contact_person['name'] = request()->cp_name;
        $contact_person['prename'] = request()->cp_prename;
        $contact_person['phone'] = request()->phone;
        $contact_person['mobile'] = request()->mobile;
        $contact_person['email'] = request()->email;

        ContactPerson::where('caterer_id', $this->caterer->id())->update( $contact_person);

        return redirect('caterer/account')->with('success' , 'Your information updated.');
            
    }


    public function getDeliveryArea()
    {

        $delivery_areas = Caterer::with('deliveryAreas')->find($this->caterer->id())->deliveryAreas;
        $zip_codes = ZipCode::with('caterers')->get();
        $zip_codes=  $zip_codes->filter(function($zip_code,$key){
            foreach($zip_code->caterers as $caterer)
                if($caterer->id ==$this->caterer->id() )
                    return false;
            return true;
        });

        return view('caterer/settings/deliveryArea',compact('delivery_areas','zip_codes'));
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

    public function postAdd()
    {
        $this->validate(request(),['zip_codes' => 'required']);

        foreach(request()->zip_codes as $zip_code)
            CatererDeliveryArea::create(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $zip_code]);

        return back()->with('success' , 'Zip code added successfully');
    }

    public function getRemove($id)
    {
        if(CatererDeliveryArea::where(['caterer_id' => $this->caterer->id(), 'zip_code_id' => $id])->delete())
            return back()->with('success','Delivery area successfully deleted.');
        return back()->withErrors('Something went wrong.');
    }


    public function uploadFile($image, $avatar, $old_image ="")
    {
        if ($old_image != "") {
            $file = 'images/products/' . $old_image;
            if(file_exists($file))
                unlink($file);
        }
        $destinationPath = 'images/products/';
        Image::make($image->getRealPath())->resize(500, 500)->save($destinationPath . '/' . $avatar);
        return $avatar;
    }
    
}
