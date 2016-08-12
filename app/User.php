<?php

namespace App;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Order;
use App\Models\ZipCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
//    use Billable;
    
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
        'is_user',
        'stripe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected static function boot(){
        parent::boot();

        static::deleting(function($user)  {
            $user->orders()->update(['admin_id' => auth()->guard('admin')->id()]);
            $user->orders()->delete();
        });

        static::restoring(function($user) {
            $user->orders()->withTrashed()->restore();
        });
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function user_zip()
    {
        return $this->belongsTo(ZipCode::class,'zip');
    }
}
