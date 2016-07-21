<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

   use SoftDeletes;

   protected $fillable = [
       'user_id',
       'caterer_id',
       'comment',
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
       'admin_id',
   ];

   protected $dates = ['deleted_at'];

   public function caterer()
   {
      return $this->belongsTo(Caterer::class);
   }
   
   public function products()
   {
      return  $this->belongsToMany(Product::class,'order_products')->withPivot('subproduct_id','amount' ,'description');
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public  function admin()
   {
      return $this->belongsTo(Admin::class);
   }

}
