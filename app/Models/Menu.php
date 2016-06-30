<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'kitchen_id', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($menu) {
            foreach($menu->products as $product) {
                $product->delete();
            }
        });

        static::restored(function ($menu) {
            dd('lklk');
            foreach($menu->products->onlyTrashed() as $product) {
                $product->restore();
            }
        });

    }
}
