<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function allProduct(Request $request)
    {
        $query = Product::where('is_active', 1);

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->get();

        $categories = Categories::orderBy('name', 'asc')->get();

        // dd($products);

        return view('site.pages.productPage.productPage', compact('products', 'categories'));
    }

    // nav bar show product 
    public function deals()
    {
        $products = Product::whereNotNull('discount_price')->latest()->get();
        $categories = Categories::orderBy('name','asc')->get();
        return view('site.pages.productPage.productPage', compact('products','categories'));
    }

    // single page Product
    public function singleProduct($id)
    {
        $product = Product::with('gallery')
        ->join('brand as b', 'products.brand_id', '=', 'b.id')
        ->join('categories as c', 'products.category_id', '=', 'c.id')
        ->select(
            'products.*',
            'b.name as brand_name',
            'c.name as category_name'
        )
        ->where('products.id', $id)
        ->first();

        // dd($product);
        return view('site.pages.productPage.singleShowPage', compact('product'));

    }

    public function addToCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session('cart', []);

        $price = $product->discount_price ?? $product->price;

        $qty = $request->quantity ?? 1; 

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty; 
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $price,
                'quantity' => $qty, 
                'photo' => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'count' => count($cart)
        ]);
    }

}
