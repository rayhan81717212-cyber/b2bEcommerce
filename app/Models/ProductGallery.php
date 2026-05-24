<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{

    protected $table = 'productgalleries';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    protected $fillable = [
        'user_id',
        "product_id",
        'photo',
    ];
}
