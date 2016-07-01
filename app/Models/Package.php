<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'caterer_id',
        'price',
        'avatar',
        'admin_id',
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('product_count');
    }
    
    public function caterer()
    {
        return $this->belongsTo(Caterer::class);
    }
}