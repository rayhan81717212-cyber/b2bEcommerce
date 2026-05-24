<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    public function commissionIndex()
    {
        $user = auth()->user();

        // admin
        if ($user->role_id == 1) {

            $data = Order::selectRaw('
                    COALESCE(SUM(total_commission),0) as total_commission,
                    COALESCE(SUM(admin_earn_total),0) as admin_earn
                ')
                ->first();

            $list = Order::latest()->paginate(10);
        }

        // VENDOR
        elseif ($user->role_id == 2) {

            $vendorId = $user->id;

            $data = OrderItem::where('vendor_id', $vendorId)
                ->selectRaw('
                    COALESCE(SUM(commission_amount),0) as total_commission,
                    COALESCE(SUM(vendor_earn),0) as total_earn
                ')
                ->first();

            $list = OrderItem::with(['order'])
                ->where('vendor_id', $vendorId) 
                ->latest()
                ->paginate(10);
        }

        else {
            abort(403, 'Unauthorized');
        }

        return view('admin.pages.commission.index', compact('data', 'list'));
    }
}
