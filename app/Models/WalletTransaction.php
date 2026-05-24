<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'source',
        'reference_id',
        'note',
        'status',
    ];
}
