<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::where('is_active', 1)
            ->latest()
            ->take(10)
            ->get();

        $bestSellers = Product::where('is_active', 1)
            ->orderBy('stock_quantity', 'asc')
            ->take(10)
            ->get();

        $categories = Categories::orderBy('name', 'asc')->get();

        $brands = Brand::orderBy('name', 'asc')->get();

        $banners = Banner::all();

        return view('site.pages.homePage', compact(
            'products',
            'bestSellers',
            'categories',
            'brands',
            'banners'
        ));
    }
}
