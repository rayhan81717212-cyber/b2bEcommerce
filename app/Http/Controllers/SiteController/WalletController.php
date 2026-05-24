<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallet()
    {
        $wallet = Wallet::firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $transactions = WalletTransaction::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customersDashboard.pages.wallet.index', compact('wallet', 'transactions'));
    }
}
