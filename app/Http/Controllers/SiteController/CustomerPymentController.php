<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class CustomerPymentController extends Controller
{
    public function payment()
    {
        $payment = Payment::from('payments as p')
            ->select(
                'p.*',
                'oi.order_number',
                'pr.name as product_name'
            )
            ->join('orders as o', 'p.order_id', '=', 'o.id')
            ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as pr', 'oi.product_id', '=', 'pr.id')
            ->where('o.user_id', auth()->id()) 
            ->orderBy('p.id', 'desc')
            ->paginate(10);
        // dd($payment);
        return view('customersDashboard.pages.paymentMethod.index', compact('payment'));
    }

   
}
