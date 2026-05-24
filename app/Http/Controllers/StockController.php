<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockLogs;
use Illuminate\Http\Request;

class StockController extends Controller
{
   
    public function index(Request $request)
    {
        $query = Product::query();

        if (auth()->user()->role_id != 1) {
            $query->where('user_id', auth()->id());
        }

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(15);

        return view('admin.pages.stock.index', compact('products'));
    }

    //  stock add 
    public function restock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        $qty = (int) $request->quantity;

        $product->stock_quantity += $qty;
        $product->save();

        $user = auth()->user();
        StockLogs::create([
            'product_id' => $product->id,
            'quantity' => $qty,
            'type' => 'in',
            'note' => "Restock (Added by: {$user->first_name} {$user->last_name})"
        ]);

        return response()->json([
            'success' => true,
            'new_stock' => $product->stock_quantity,
            'product_id' => $product->id,
            'message' => 'Stock updated successfully'
        ]);
    }

    // stock logs data get
    public function stockLogsGet(Request $request)
    {
        $query = StockLogs::with('product');

        
        if (auth()->user()->role_id != 1) {

            $query->whereHas('product', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        // filter 
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $logs = $query->latest()->paginate(15);

        // dd($logs);
        return view('admin.pages.stock.stockLogs', compact('logs'));
    }
}

