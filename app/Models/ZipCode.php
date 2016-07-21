<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{

    protected $fillable = ['ZIP' , 'city'];

    public function caterers(){
        return $this->belongsToMany(Caterer::class,'caterer_delivery_areas');
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
