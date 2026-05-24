<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPoint extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'user_id',
        'points',
    ];
}
