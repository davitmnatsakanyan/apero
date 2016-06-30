<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//           'company'            => 'required|max:250',
//           'address'            => 'required|max:250',
//           'pobox'              => 'required|max:100',
//           'zip'                => 'required|max:4',
//           'city'               => 'required|max:250',
//           'country'            => 'required|max:250',
//           'email'              => 'required|email|max:100',
//           'phone'              => 'required|max:50',
//           'password'           => 'required|confirmed',
//           'rpassword' => 'required',
//            'fax'               => 'required',
//            'description'       => 'required',
//            'person_title'      => 'required',
//            'person_prename'    => 'required',
//            'person_name'       => 'required',
//            'person_mobile'     => 'required',
//            'person_phone'      => 'required',
//            'person_email'      => 'required',
//            'kitchen'           => 'required',
//            'delivery_area'     => 'required',
//            'product_origin'    => 'required'
        ];

    }
}
