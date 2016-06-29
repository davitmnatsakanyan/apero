<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caterer extends Authenticatable
{

    use SoftDeletes;
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
        'deleted_at',
        'created_ip',
        'is_deleted',
        'admin_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class);
    }
}
