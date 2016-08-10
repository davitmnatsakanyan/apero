<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageProduct extends Model
{
    protected $table = 'package_product';

    protected $fillable = [
        'product_id',
        'package_id',
        'product_count',
        'subproduct_id',
    ];
}