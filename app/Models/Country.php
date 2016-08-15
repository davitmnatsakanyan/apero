<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'iso',
        'name'
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

}