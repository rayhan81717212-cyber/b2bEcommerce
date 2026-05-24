<?php
namespace App\Services;

use App\Models\LoyaltyPoint;
use App\Models\LoyaltyTransaction;

class LoyaltyService
{
    public function earn($userId, $amount, $orderId)
    {
        $points = intval($amount / 100); // 100 TK = 1 point

        if ($points <= 0) return;

        $loyalty = LoyaltyPoint::firstOrCreate(['user_id' => $userId]);

        $loyalty->increment('points', $points);

        LoyaltyTransaction::create([
            'user_id' => $userId,
            'points' => $points,
            'type' => 'earn',
            'source' => 'order',
            'reference_id' => $orderId
        ]);
    }
}