<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $table = "products";

   protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'brand_id',
        'short_description',
        'description',
        'price',
        'discount_price',
        'stock_quantity',
        'status',
        'photo',
        'is_active'
    ];


    public function gallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLogs::class);
    }
}
