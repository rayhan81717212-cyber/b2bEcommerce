<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table = "orders";
   protected  $fillable = [
         'user_id',
         'amount',
         'shipping_fee',
         'grand_total',
         'payment_method',
         'payment_status',
         'status', 
         "barcode",
   ];

   public function items()
   {
      return $this->hasMany(OrderItem::class);
   }
   
   public function payment()
   {
      return $this->hasOne(Payment::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }
 

}
