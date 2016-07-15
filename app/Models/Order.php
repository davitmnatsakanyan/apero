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
       'delivery_time',
       'email',
       'phone',
       'mobile',
       'payment_type',
       'status',
       'total_cost',
       'remember_token',
       'billing_address',
       'is_user_order',
   ];

   public function caterer()
   {
      return $this->belongsTo(Caterer::class);
   }
   
   public function products()
   {
      return  $this->belongsToMany(Product::class,'order_products')->withPivot('subproduct_id','amount' ,'description');
   }

}
