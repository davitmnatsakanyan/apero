<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'caterer_id',
        'ingredients',
        'category_id',
        'price',
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('product_count');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}


