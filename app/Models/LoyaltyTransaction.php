<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    protected $table = 'loyalty_transactions';
    protected $fillable = [
        'user_id',
        'points',
        'type',
        'source',
        'reference_id',
    ];
}
