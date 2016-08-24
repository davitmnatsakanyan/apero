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
           'company'   => 'required|max:250',
           'name'      => 'required|max:250',
//           'avatar'    => 'image|max:250',
           'address'   => 'required|max:250',
           'pobox'     => 'required|max:100',
           'zip'       => 'required|max:4',
           'city'      => 'required|max:250',
           'country'   => 'required|max:250',
           'email'     => 'required|email|max:100',
           'phone'     => 'required|max:50',
           'mobile'    => 'required|max:50',
//           'password'  => 'required|confirmed',
//           'password_confirmation' => 'required',
           //'created_ip' => 'required|ip',
        ];
        
        //regex
    }
}
