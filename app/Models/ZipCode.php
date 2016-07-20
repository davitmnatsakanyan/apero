<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{

    protected $fillable = ['ZIP' , 'city'];

    public function caterers(){
        return $this->belongsToMany(Caterer::class,'caterer_delivery_areas');
    }

}
