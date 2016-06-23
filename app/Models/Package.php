<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'caterer_id',
    ];
    
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_count');
    }
}