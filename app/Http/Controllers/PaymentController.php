<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    
    public function paymentIndex()
    {
        $query = Payment::with(['order.user', 'order.items.product']);

        
        if (auth()->user()->role_id == 1) {
          
        }
        elseif (auth()->user()->role_id == 2) {
            $vendorId = auth()->id();

            $query->whereHas('order.items', function ($q) use ($vendorId) {
                $q->whereHas('product', function ($q2) use ($vendorId) {
                    $q2->where('user_id', $vendorId);
                });
            });
        }

        $payments = $query->latest()->paginate(10);

        return view('admin.pages.paymentMethod.index', compact('payments'));
    }
    public function invoice($id)
    {
        $order = Order::with(['payment','items.product','user'])
            ->findOrFail($id);

        return view('admin.pages.paymentMethod.invoice', compact('order'));
    }

}
