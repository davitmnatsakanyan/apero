<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitchenMenu extends Model
{
    protected $table = 'kitchen_menu';
    
    protected $fillable = [
        'kitchen_id',
        'menu_id',
    ];
}