<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'price',
        'subproduct_id',
        'description'
    ];
    
}
