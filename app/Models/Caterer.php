<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Caterer extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company',
        'name', 
        'email', 
        'password',
        'avatar',
        'address',
        'pobox',
        'zip',
        'city',
        'country',
        'phone',
        'mobile',
        'desc',
        'remember_token',
        'description',
        'products_origin',
        'created_at',
        'updated_at',
        'deleted_time',
        'created_ip',
        'deliter_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
