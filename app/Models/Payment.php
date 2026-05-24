<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = [
        "order_id",
        "payment_method",
        "amount",
        "shipping_fee",
        "grand_total",
        "status"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
