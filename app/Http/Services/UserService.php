<?php
namespace App\Http\Services;
use App\User;

class UserService
{
//    use \App\Http\Traits\CRUD;
    
    private $model;

    /**
     * Initializing data special for user type
     * 
     * @param User $user
     */
    public function __construct( User $user )
    {
        $this->model = $user;
    }

    public function create($data){
        $model = User::create([
            'name'      => $data['name'],
            'title'     => $data['title'],
            'address'   => $data['address'],
            'pobox'     => $data['pobox'],
            'zip'       => $data['zip'],
            'city'      => $data['city'],
            'country'   => $data['country'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'phone'     => $data['phone'],
            'mobile'    => $data['mobile'],
            'fax'       => $data['fax'],
            'created_ip' => $data['created_ip'],
            'is_user'   =>1,
        ]);

        return $model;
    }
   
}