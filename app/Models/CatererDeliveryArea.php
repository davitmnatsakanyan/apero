<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatererDeliveryArea extends Model
{
    protected $table = 'caterer_delivery_areas';

    protected $fillable = ['caterer_id' , 'zip_code_id'];
}