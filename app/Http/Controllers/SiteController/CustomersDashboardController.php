<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomersDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::from('orders as o')
             ->select(
                'o.id',
                'o.created_at',
                'oi.status',
                'oi.id as order_list_id',
                'oi.price',
                'oi.quantity',
                'oi.order_number',
                'p.name as productName',
                'p.photo as productPhoto'
            )
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
            ->where('o.user_id', auth()->id())
            ->orderBy('o.id', 'desc')
            ->limit(5)
            ->get();

        return view('customersDashboard.pages.customerDashboard', compact('orders'));
    }

    public function allOrder()
    {
        $orders = Order::from('orders as o')
            ->select(
                'o.id',
                'o.created_at',
                'oi.status',
                'oi.id as order_list_id',
                'oi.price',
                'oi.quantity',
                'oi.order_number',
                'p.name as productName',
                'p.photo as productPhoto'
            )
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
            ->where('o.user_id', auth()->id())
            ->orderBy('o.id', 'desc')
            ->get();
        // dd($orders);
        return view('customersDashboard.pages.order.index', compact('orders'));
    }
    public function show($id)
    {
        $order = OrderItem::from('order_items as oi')
            ->select('oi.order_number', 'oi.price', 'oi.status', 'oi.created_at', 'p.name as productName', 'p.photo as productPhoto')
            ->leftJoin('products as p', 'oi.product_id', '=', 'p.id')
            ->where('oi.id', $id)
            ->firstOrFail();
        // dd($order);
        return view('customersDashboard.pages.order.show', compact('order'));
    }
}
