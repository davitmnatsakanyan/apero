<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'name',
       'caterer_id',
       'ingredients',
        'price',
    ];
}
