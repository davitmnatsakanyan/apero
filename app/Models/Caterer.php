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
        'email', 
        'password',
        'avatar',
        'address',
        'pobox',
        'zip',
        'city',
        'country',
        'phone',
        'remember_token',
        'description',
        'products_origin',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_ip',
        'admin_id',
        'fax'
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


    public function packages()
    {
        return $this->belongsTo(Package::class);
    }
    
    
    public function zips()
    {
       return  $this->belongsToMany(ZipCode::class, 'caterer_delivery_areas');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($caterer) {
            //stex kjnjem sax
            $caterer->orders()->withTrashed()->forceDelete();
        });
    }
    
    public function cookingtime(){
        return $this->hasOne(CookingTime::class);
    }

    public function contact_person()
    {
        return $this->hasOne(ContactPerson::class);
    }
}
