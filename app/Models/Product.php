<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['name','avatar', 'ingredinets', 'price', 'caterer_id', 'menu_id', 'deleted_at'];

    protected $dates = ['deleted_at'];

    public function menus()
    {
        return $this->belongsTo(Menu::class);
    }

    public function subproducts()
    {
        return $this->hasMany(Subproduct::class);

    }
    
    public function caterer()
    {
        return $this->belongsTo(Caterer::class);
    }
}
