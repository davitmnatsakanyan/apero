<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kitchen extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */

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
    protected $fillable = ['name','deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];




    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function caterers()
    {
        return $this->belongsToMany(Caterer::class);
    }

    
}
