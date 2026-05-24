<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\StockLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;


class PosController extends Controller
{
    public function posPage()
    {
        $user = auth()->user();

        $products = Product::where('is_active', 1)
            ->when($user->role_id != 1, function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with('category')
            ->latest()
            ->paginate(30); 

        
        $categories = Product::where('is_active', 1)
            ->when($user->role_id != 1, function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with('category')
            ->get()
            ->pluck('category')
            ->filter()
            ->unique('id')
            ->values();

        return view('admin.vendor.pages.pos', compact('products','categories'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        $price = $product->discount_price ?? $product->price;

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $price,
                'photo' => $product->photo,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success'=>true]);
    }

    public function cartData()
    {
        return response()->json([
            'cart' => session('cart', [])
        ]);
    }

    public function cartUpdate(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->product_id;

        if(!isset($cart[$id])){
            return response()->json(['success'=>false]);
        }

        if($request->type == 'update'){

            if($request->action == 'plus'){
                $cart[$id]['quantity']++;
            }

            if($request->action == 'minus'){
                $cart[$id]['quantity']--;

                if($cart[$id]['quantity'] <= 0){
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success'=>true]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success'=>true]);
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ]);
        }

        try {

            $order = DB::transaction(function () use ($cart, $request) {

                $total = 0;
                $shipping_fee = 0; 

                $order = Order::create([
                    'user_id'        => auth()->id(),
                    'amount'         => 0,
                    'shipping_fee'   => $shipping_fee,
                    'grand_total'    => 0,
                    'payment_method' => $request->payment_method ?? 'cash',
                    'payment_status' => 'paid',
                    'status'         => 'completed',
                    'barcode'        => strtoupper('POS-' . uniqid())
                ]);

                foreach ($cart as $id => $item) {

                    $product = Product::lockForUpdate()->find($id);

                    if (!$product) {
                        throw new \Exception("Product not found");
                    }

                    if ($product->stock_quantity < $item['quantity']) {
                        throw new \Exception("Stock not available for {$product->name}");
                    }

                    // stock decrease
                    $product->decrement('stock_quantity', $item['quantity']);

                    $lineTotal = $item['price'] * $item['quantity'];
                    $total += $lineTotal;

                    OrderItem::create([
                        'order_id'     => $order->id,
                        'vendor_id'    => $product->user_id ?? 0,
                        'order_number' => $order->barcode,
                        'product_id'   => $id,
                        'quantity'     => $item['quantity'],
                        'price'        => $item['price'],
                        'status'       => 'completed'
                    ]);

                    StockLogs::create([
                        'product_id' => $product->id,
                        'quantity'   => $item['quantity'],
                        'type'       => 'out', 
                        'note'       => 'Order Checkout (Order: ' . $order->barcode . ')'
                    ]);
                }

                
                $grand_total = $total + $shipping_fee;

                // payment create
                Payment::create([
                    'order_id'       => $order->id,
                    'payment_method' => $request->payment_method ?? 'cash',
                    'amount'         => $total,
                    'shipping_fee'   => $shipping_fee,
                    'grand_total'    => $grand_total,
                    'status'         => "paid"
                ]);

               
                //  Update Order
                $order->update([
                    'amount'       => $total,
                    'grand_total'  => $grand_total,
                    'shipping_fee' => $shipping_fee
                ]);

                return $order;
            });

            session()->forget('cart');

            return response()->json([
                'success'  => true,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    

    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        $orderitem = OrderItem::from('order_items as oi')
                    ->select('u.first_name', 'u.last_name', 'v.shop_name', 'v.address', 'v.mobile_number')
                    ->leftJoin('users as u', 'u.id', '=', 'oi.vendor_id')
                    ->leftJoin('vendors as v', 'u.id', '=', 'v.user_id')
                    ->where('oi.order_id', $id) 
                    ->first(); 
                    
        $code = str_replace('-', '', $order->barcode);

        $generator = new BarcodeGeneratorPNG();

        $barcodeImage = base64_encode(
            $generator->getBarcode($code, $generator::TYPE_CODE_128)
        );

        // dd($orderitem);
        return view('admin.vendor.pages.invoice', compact('order', 'barcodeImage', 'orderitem'));
    }
}