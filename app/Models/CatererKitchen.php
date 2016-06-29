<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatererKitchen extends Model
{
    protected $table = 'caterer_kitchen';
    protected $fillable = [
        'caterer_id',
        'kitchen_id',
    ];
}