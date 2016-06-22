<?php
namespace App\Http\Services;
use App\User;

class UserService
{
    use \App\Http\Traits\CRUD;
    
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
   
}