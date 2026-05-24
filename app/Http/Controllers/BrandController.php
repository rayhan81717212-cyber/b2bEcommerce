<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    
    public function index()
    {
        $query = Brand::from('brand as b')
            ->select(
                'b.id',
                'b.name',
                'b.logo',
                'b.description',
                'u.first_name',
                'u.last_name'
            )
            ->leftJoin('users as u', 'b.user_id', '=', 'u.id')
            ->orderBy('b.name', 'asc');
            
        if (auth()->user()->role_id == 2) {
            $query->where('b.user_id', auth()->id());
        }

        $brand = $query->paginate(10);

        return view("admin.pages.productManagement.brand.index", compact('brand'));
    }

    public function show($id){
        $brandId = Brand::from('brand as b')
                    ->select('b.*')
                    ->where('b.id', '=', $id)
                    ->first();
        // dd($brandId);
        return view("admin.pages.productManagement.brand.show", compact('brandId'));
    }

    public function create(){
        return view('admin.pages.productManagement.brand.create');
    }

    public function store(Request $request ){
        // dd($request->all());

         if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('brands', 'public');
        }else{
           $photo = null; 
        }

        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
    ]);

        $user_id = auth()->user()->id;
        $brand = Brand::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $photo,
        ]);

        return redirect()->route('brand.index')->with('success', "Brand Add Successfull!");
    }

    public function edit($id){
        $brandItem = Brand::find($id);
        // dd($brandItem);
        return view("admin.pages.productManagement.brand.edit", compact('brandItem'));
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $brandItem = Brand::find($id);

      $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'mimes:jpeg,png,jpg,webp'
        ]);

        $oldPhoto = $brandItem->photo;
         if ($request->hasFile('photo')) {
            if ($oldPhoto && Storage::exists('public/' . $oldPhoto)) {
                Storage::delete('public/' . $oldPhoto);
            }
                $photo = $request->file('photo')->store('brand', 'public');
            } else {
                $photo = $oldPhoto;
            }

        $brandItem->update([
            'name'=> $request->name,
            "description"=> $request->description,
            'logo'=> $photo
        ]);

        // dd($brandItem);

        return redirect()->route("brand.index")->with("success", "Brand Update Successfully!"); 
    }

    public function destroy($id){
        $brandId = Brand::find($id);

        $brandId->delete();

        // dd($brandId);
        return redirect()->route("brand.index")->with('success', "Brand Delete Successfully!");
    }

}
