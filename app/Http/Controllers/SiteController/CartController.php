<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
     public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $quantity = $item['quantity'] ?? 0;
            $total += $item['price'] * $quantity;
        }


        return view('site.layout.nav', compact('cart', 'total'));
    }

    

   public function addToCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        $price = $product->discount_price ?? $product->price;

        $existingQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;

        
        if ($product->stock_quantity <= $existingQty) {
            return response()->json([
                'success' => false,
                'message' => 'Out of stock'
            ]);
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $price,
                'quantity' => 1,
                'photo' => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function cartPage()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $quantity = $item['quantity'] ?? 0;
            $total += $item['price'] * $quantity;
        }

        return view('site.pages.cartPage.cartpage', compact('cart', 'total'));
    }

     /**
     * Update the specified resource in storage.
     */
  public function cartUpdate(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->product_id;

        $itemTotal = 0;

        // Update
        if ($request->type == 'update') {

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $request->quantity);
            }
        }

        // delete
        if ($request->type == 'delete') {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        $total = 0;

        foreach ($cart as $key => $item) {
            $qty = $item['quantity'] ?? 1;
            $price = $item['price'] ?? 0;

            $total += $price * $qty;

            if ($key == $id) {
                $itemTotal = $price * $qty;
            }
        }

        return response()->json([
            'success' => true,
            'total' => $total,
            'item_total' => $itemTotal,
            'count' => count($cart),
        ]);
    }
}
