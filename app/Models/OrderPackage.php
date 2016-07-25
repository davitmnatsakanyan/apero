<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{

    protected $table = 'order_package';

    protected $fillable = [
        'order_id',
        'package_id',
        'amount',
        'price',
        'description'
    ];

}