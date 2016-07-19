<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookingTime extends Model
{
    protected $fillable = [
        'group1',
        'group2',
        'group3',
        'caterer_id'
    ];
    
}
