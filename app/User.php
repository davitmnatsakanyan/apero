<?php

namespace App;

use App\Models\ZipCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'address',
        'pobox',
        'zip',
        'city',
        'country',
        'title',
        'email',
        'phone',
        'mobile',
        'password',
        'role',
        'is_deleted',
        'admin_id',
        'deleted_at',
        'remember_token',
        'created_at',
        'updated_at',
        'created_ip',
        'is_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->orders()->withTrashed()->forceDelete();
        });
    }
    
    
    public function user_zip()
    {
        return $this->belongsTo(ZipCode::class);
    }
}
