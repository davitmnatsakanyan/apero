<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
       'user_id',
       'caterer_id',
       'delivery_address',
       'delivery_zip',
       'delivery_city',
       'delivery_country',
       'email',
       'phone',
       'mobile',
       'payment_type',
       'status',
       'total_cost',
       'remember_token',
       'billing_address'
   ];
}
