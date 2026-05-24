<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;




class ProductController extends Controller
{
    public function getProducts($brand_id)
    {
        $products = product::where('brand_id', $brand_id)->get();
        // dd($products);
        return response()->json($products);
    }
    public function index()
    {
        $user = auth()->user();

        $query = Product::from('products as p')
            ->select(
                'p.*',
                'b.name as brand_name',
                'c.name as category_name',
                'u.first_name',
                'u.last_name'
            )
            ->leftJoin('brand as b', 'p.brand_id', '=', 'b.id')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('is_active', 1)
            ->orderBy('p.id', 'desc');

        
        if ($user->role_id == 2) {
            $query->where('p.user_id', $user->id);
        }

    
        $product = $query->paginate(10);

        return view('admin.pages.productManagement.product.index', compact('product'));
    }

     // pending Product show all 
    public function pendingProduct(){
        $user = auth()->user();

        $query = Product::from('products as p')
            ->select(
                'p.*',
                'b.name as brand_name',
                'c.name as category_name',
                'u.first_name',
                'u.last_name'
            )
            ->leftJoin('brand as b', 'p.brand_id', '=', 'b.id')
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->where('is_active', 0)
            ->orderBy('p.id', 'desc');

        
        if ($user->role_id == 2) {
            $query->where('p.user_id', $user->id);
        }

    
        $product = $query->paginate(10);

        return view('admin.pages.productManagement.product.penddingProduct', compact('product'));
    }

// pending producut aproved
    public function productApproved($id)
    {
        $product = Product::findOrFail($id);

        $product->is_Active = 1;
        $product->save();

        return redirect()->route('product.index')->with('success', "Product Approved Successfully!");
    }

    public function show($id){
        $productId = Product::from('products as p')
        ->select('p.*', 'b.name as brand_name', 'c.name as category_name')
        ->join('brand as b', 'p.brand_id', '=', 'b.id')
        ->join('categories as c', 'p.category_id', '=', 'c.id')
        ->where("p.id", "=", $id)
        ->first();

        // dd($productId);
        return view("admin.pages.productManagement.product.show", compact('productId'));
    }


    public function create(){
         
            $brand = Brand::orderBy('name', 'asc')->get();
            $categories = Categories::orderBy('name', 'asc')->get();
    

        //   dd($brand, $categories);
          return view('admin.pages.productManagement.product.create', compact('brand', "categories"));      
    }

    public function store(Request $request){
        // dd($request->all());

        if($request->hasFile("photo")){
            $photo = $request->file('photo')->store("product", 'public');
        }else{
            $photo = null;
        }
        $price = str_replace(',', '', $request->price);
        $discount_price = $request->discount_price ? str_replace(',', '', $request->discount_price) : null;

        $request->validate([
            'photo' => [ 'mimes:png,jpg,jpeg,webp','image', 'max:1000'],
        ]);

        $user_id = auth()->user()->id;
        $isActive = auth()->user()->role_id == 1 ? 1 : 0;

      
        $product = Product::create([
            'user_id'=> $user_id,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $price,
            'discount_price' => $discount_price,
            'stock_quantity' => $request->stock_quantity,
            'status' => $request->status,
            'photo' =>$photo,
            'is_active'=>$isActive
            
        ]);
        // dd($product);
        return redirect()->route('product-pending')->with('success', "Product Add Successfully!");

    }
   
    public function edit($id){
        
        // $product = Product::from('products as p')
        //         ->select('p.*', 'b.name as brand_name', 'c.name as category_name')
        //         ->join('brand as b', 'p.brand_id', '=', 'b.id')
        //         ->join('categories as c', 'p.category_id', '=', 'c.id')
        //         ->where('p.id', $id)
        //         ->first();

        $product = Product::find($id);
        $brand = Brand::all();
        $categories = Categories::all();
        $page = request()->query("page", 1);

        // dd($product, $brand, $categories);
        return view('admin.pages.productManagement.product.edit', compact('product', 'brand', 'categories', 'page'));
    }

    public function update(Request $request, $id){

        $product = Product::find($id);

        $photo = $product->photo; 

        if ($request->hasFile('photo')) {
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }

            $photo = $request->file('photo')->store('product', 'public');
        }

        $price = str_replace(',', '', $request->price);
        $discount_price = $request->discount_price ? str_replace(',', '', $request->discount_price) : null;

        $product -> update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $price,
            'discount_price' => $discount_price,
            'stock_quantity' => $request->stock_quantity,
            'status' => $request->status,
            'photo' =>$photo,
            
        ]);

        return redirect()->route('product.index')->with('success', "Product Update Successfully!");

    }

    public function destroy($id){
        $product = Product::find($id);

        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
        Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route("product.index")->with('success', "Product Delete Successfully!");
        // dd($product);

        // return
    }

   public function search(Request $request){
        $search = $request->input('search');

        $product = Product::query()
        ->join('brand as b', 'products.brand_id', '=', 'b.id')
        ->join('categories as c', 'products.category_id', '=', 'c.id')
        ->select('products.*', 'b.name as brand_name', 'c.name as category_name')
        ->orderBy('products.name', 'asc')
        ->when($search, function ($query, $search) {
            $query->where('products.name', 'like', "%{$search}%")
                ->orWhere('products.description', 'like', "%{$search}%")
                ->orWhere('b.name', 'like', "%{$search}%")
                ->orWhere('c.name', 'like', "%{$search}%");
        })
        ->paginate(10);


        return view('admin.pages.productManagement.product.index', compact('product', 'search'));
    }


    // Site Route 
    public function getAllProduct() {
        $products = Product::from('products as p')
            ->select('p.*', 'b.name as brand_name', 'c.name as category_name')
            ->join('brand as b', 'p.brand_id', '=', 'b.id')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('p.id', 'desc')
            ->paginate(12)       
            ->onEachSide(1);     

        $banner = Banner::all();
        $brand = Brand::all();
        return view('site.pages.index', compact('products', "banner", 'brand'));
    }

    

    // site single data collect    
    public function getProductById($id)
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
    return view('site.pages.product-details.show', compact('product'));
    }



}