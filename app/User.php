<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'avatar', 'company', 'address', 'pobox', 'zip', 'city', 'country', 'email', 'phone', 'mobile', 'password', 'role', 'is_deleted', 'admin_id', 'deleted_at', 'remember_token', 'created_at', 'updated_at', 'created_ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
