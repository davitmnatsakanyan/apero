<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageProduct extends Model
{
    protected $fillable = [
        'product_id',
        'package_id',
    ];
}