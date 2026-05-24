<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Categories::from('categories as c')
            ->select('c.*', 'u.first_name', 'u.last_name')
            ->leftJoin('users as u', 'c.user_id', '=', 'u.id')
            ->orderBy('c.name', 'asc');
            
        if (auth()->user()->role_id == 2) {
            $query->where('c.user_id', auth()->id());
        }

        $categories = $query->paginate(15);

        return view('admin.pages.productManagement.categories.index', compact('categories'));
    }

    // public function show($id){
    //     $categories = Categories::from('categories as c')
    //                             ->select('c.*')
    //                             ->where('c.id', '=', $id);
    //     return view('', compact())
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.productManagement.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $categories = Categories::create([
            'user_id' => $user_id,
            'name'=> $request->name,
            'status'=>$request->status,
        ]);
        // dd($categories);
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');

        
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $categories = Categories::find($id);

        //  dd($categories);
        return view("admin.pages.productManagement.categories.edit", compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categories = Categories::find($id);

        $categories->update([
            'name'=> $request->name,
            'status'=> $request->status
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $categories = Categories::find($id);

        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Category Delete successfully!');
    }
}
