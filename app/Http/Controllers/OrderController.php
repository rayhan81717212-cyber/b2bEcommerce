<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StockLogs;

class OrderController extends Controller
{

    // admin Order show
    public function index()
    {
        $query = Order::from('orders as o')
            ->select(
                'o.created_at',
                'o.shipping_fee',
                'o.payment_method',
                'oi.id',
                'oi.status',
                'oi.price',
                'oi.quantity',
                'oi.order_number',
                'p.name as productName',
                'p.photo as productPhoto',
                'u.first_name as firstName',
                'u.last_name as lastName',
            )
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
            ->orderBy('o.id', 'desc');

        
        if (auth()->user()->role_id == 2) {
            $query->where('oi.vendor_id', auth()->id());
        }


        $orders = $query->paginate(10);
        // dd($orders);
        return view('admin.pages.orderManagement.allOrder', compact('orders'));
    }
    // admin Order clan
    public function cancleOrder(){

            $query = Order::from('orders as o')
                ->select(
                'o.created_at',
                'o.shipping_fee',
                'o.payment_method',
                'oi.id',
                'oi.status',
                'oi.price',
                'oi.quantity',
                'oi.order_number',
                'p.name as productName',
                'p.photo as productPhoto',
                'u.first_name as firstName',
                'u.last_name as lastName',
            )
                ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
                ->where('oi.status', 'cancelled')
                ->orderBy('o.id', 'desc');

            
            if (auth()->user()->role_id == 2) {
                $query->where('oi.vendor_id', auth()->id());
            }


        $orders = $query->paginate(10);
      
        // dd($order);
        return view('admin.pages.orderManagement.cancleOrder',  compact('orders'));
     
    }
    // admin Order pending
    public function pendingOrder(){

        $query = Order::from('orders as o')
                ->select(
                'o.created_at',
                'o.shipping_fee',
                'o.payment_method',
                'oi.id',
                'oi.status',
                'oi.price',
                'oi.quantity',
                'oi.order_number',
                'p.name as productName',
                'p.photo as productPhoto',
                'u.first_name as firstName',
                'u.last_name as lastName',
                )
                ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
                ->where('oi.status', 'pending')
                ->orderBy('o.id', 'desc');

            
            if (auth()->user()->role_id == 2) {
                $query->where('oi.vendor_id', auth()->id());
            }


        $orders = $query->paginate(10);
        // dd($order);
        return view('admin.pages.orderManagement.pendingOrder',  compact('orders'));
     
    }
    // admin Order delivery
    public function deliveredOrder(){

        $query = Order::from('orders as o')
                ->select(
                    'o.created_at',
                    'o.shipping_fee',
                    'o.payment_method',
                    'oi.id',
                    'oi.status',
                    'oi.price',
                    'oi.quantity',
                    'oi.order_number',
                    'p.name as productName',
                    'p.photo as productPhoto',
                    'u.first_name as firstName',
                    'u.last_name as lastName',
                )
                ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
                ->where('oi.status', 'delivered')
                ->orderBy('o.id', 'desc');

            
            if (auth()->user()->role_id == 2) {
                $query->where('oi.vendor_id', auth()->id());
            }


        $orders = $query->paginate(10);
      
        // dd($order);
        return view('admin.pages.orderManagement.deliveredOrder',  compact('orders'));
     
    }
    // confirmed Order delivery
    public function confirmedOrder(){

        $query = Order::from('orders as o')
                ->select(
                    'o.created_at',
                    'o.shipping_fee',
                    'o.payment_method',
                    'oi.id',
                    'oi.status',
                    'oi.price',
                    'oi.quantity',
                    'oi.order_number',
                    'p.name as productName',
                    'p.photo as productPhoto',
                    'u.first_name as firstName',
                    'u.last_name as lastName',
                )
                ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
                ->where('oi.status', 'confirmed')
                ->orderBy('o.id', 'desc');

            
            if (auth()->user()->role_id == 2) {
                $query->where('oi.vendor_id', auth()->id());
            }


        $orders = $query->paginate(10);
      
        // dd($order);
        return view('admin.pages.orderManagement.confirmedOrder',  compact('orders'));
    }
    // processing route
    public function processingOrder(){

        $query = Order::from('orders as o')
                ->select(
                    'o.created_at',
                    'o.shipping_fee',
                    'o.payment_method',
                    'oi.id',
                    'oi.status',
                    'oi.price',
                    'oi.quantity',
                    'oi.order_number',
                    'p.name as productName',
                    'p.photo as productPhoto',
                    'u.first_name as firstName',
                    'u.last_name as lastName',
                )
                ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->leftJoin('products as p', 'p.id', '=', 'oi.product_id')
                ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
                ->where('oi.status', 'processing')
                ->orderBy('o.id', 'desc');

            
            if (auth()->user()->role_id == 2) {
                $query->where('oi.vendor_id', auth()->id());
            }


        $orders = $query->paginate(10);
      
        // dd($order);
        return view('admin.pages.orderManagement.processingOrder',  compact('orders'));
     
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $item = OrderItem::findOrFail($id);

        $oldStatus = $item->status;
        $newStatus = $request->status;

        $item->status = $newStatus;
        $item->save();

        $product = Product::find($item->product_id);

        /* stock Out */
        if ($oldStatus != 'confirmed' && $newStatus == 'confirmed') {

            if ($product->stock_quantity < $item->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock not available'
                ]);
            }

            
            $product->stock_quantity -= $item->quantity;
            $product->save();

            // log item
            StockLogs::create([
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'type' => 'out',
                'note' => 'Order Confirmed (Item ID: '.$item->id.')'
            ]);
        }

        /*cancelled product return stock*/
        if ($oldStatus == 'confirmed' && in_array($newStatus, ['cancelled','returned'])) {

           
            $product->stock_quantity += $item->quantity;
            $product->save();

            // log item
            StockLogs::create([
                'product_id' => $product->id,
                'quantity' => $item->quantity,
                'type' => 'in',
                'note' => 'Order Cancel/Return (Item ID: '.$item->id.')'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status updated with inventory'
        ]);
    }

}
