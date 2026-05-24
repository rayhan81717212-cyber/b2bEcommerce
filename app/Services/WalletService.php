<?php
namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class WalletService
{
    
    public function credit($userId, $amount, $source, $refId = null)
    {
        DB::transaction(function () use ($userId, $amount, $source, $refId) {

            $wallet = Wallet::firstOrCreate(['user_id' => $userId]);

            $wallet->increment('balance', $amount);

            WalletTransaction::create([
                'user_id' => $userId,
                'type' => 'credit',
                'amount' => $amount,
                'source' => $source,
                'reference_id' => $refId
            ]);
        });
    }

    public function debit($userId, $amount, $source, $refId = null)
    {
        DB::transaction(function () use ($userId, $amount, $source, $refId) {

            $wallet = Wallet::firstOrCreate(['user_id' => $userId]);

            if ($wallet->balance < $amount) {
                throw new \Exception("Insufficient balance");
            }

            $wallet->decrement('balance', $amount);

            WalletTransaction::create([
                'user_id' => $userId,
                'type' => 'debit',
                'amount' => $amount,
                'source' => $source,
                'reference_id' => $refId
            ]);
        });
    }
}