<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    protected $table = "order_items";

    protected $fillable = [
        'order_id',
        'vendor_id',
        'product_id',
        'quantity',
        'price',
        'status',
        'order_number',
        'commission_amount',
        'admin_earn',
        'vendor_earn',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
