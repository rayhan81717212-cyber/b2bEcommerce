<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'country',
        'postal_code',
        'profile_image',
        'status',
    ];
}
