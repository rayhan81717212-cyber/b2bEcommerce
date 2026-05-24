<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user = User::from('users as u')
                ->select('u.id','u.first_name', 'u.last_name', 'u.email', 'u.role_id', 'u.vendor_status', 'u.phone', 'u.photo', 'r.name as role', 'v.mobile_number', 'v.shop_name')
                ->leftJoin('roles as r', 'u.role_id', '=', "r.id")
                ->leftJoin('vendors as v', 'u.id', '=', 'v.user_id')
                ->whereIn('u.role_id', [1, 2])
                ->where('u.vendor_status', 1)
                ->orderByRaw("FIELD(role, 'Admin', 'Vendor')")
                ->paginate(10);

        return view('admin.pages.userManage.user.index', compact('user'));
    }
    public function pendingVendors()
    {
        
        $user = User::from('users as u')
                ->select('u.id','u.first_name', 'u.last_name', 'u.email', 'u.role_id', 'u.vendor_status', 'u.phone',  'u.photo', 'r.name as role', 'v.mobile_number', 'v.shop_name')
                ->leftJoin('roles as r', 'u.role_id', '=', "r.id")
                ->leftJoin('vendors as v', 'u.id', '=', 'v.user_id')
                ->where('u.role_id',  2)
                ->where('u.vendor_status', 0)
                ->orderByRaw("FIELD(role, 'Vendor')")
                ->paginate(10);

        // dd($user);
        return view('admin.pages.userManage.user.pendingUsers', compact('user'));
    }
    public function customerDataGet()
    {
        
        $user = User::from('users as u')
                ->select('u.id','u.first_name', 'u.last_name', 'u.email', 'u.role_id', 'u.status', 'u.phone', 'u.photo', 'r.name as role')
                ->join('roles as r', 'u.role_id', '=', "r.id")
                ->whereIn('u.role_id', [4])
                ->paginate(10);

        return view('admin.pages.userManage.user.customers', compact('user'));
    }

    // approved vendors
    public function approvedVendors($id)
    {
        $users = User::findOrFail($id);

        $users->vendor_status = 1;
        $users->save();

        return redirect()->route('user.index')->with('success', "Vendors Approved Successfully!");
    }

     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::from('users as u')
                ->select('u.*', 'r.name as role')
                ->join('roles as r', 'u.role_id', '=', "r.id")
                ->where('u.id', $id)
                ->first();
        // dd($user);

         return view('admin.pages.userManage.user.show', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Roles::all();
        return view("admin.pages.userManage.user.create", compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name'  => 'required|min:2|max:30',
            'email'      => 'required|email|unique:users,email',
            'password'  => 'required|min:4|confirmed',
            'role_id'    => 'required|integer|exists:roles,id',
            'status'     => 'required|string|in:Active,Inactive',
            'phone'      => 'required|string|max:15',
            'photo'      => ['nullable','image','mimes:jpeg,png,jpg','max:1000'],
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('user', 'public');
        }

        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=> $request->phone,
            'role_id'=> $request->role_id,
            'status'=> $request->status,
            'photo'=> $photo ?? null,
            'vendor_status'=> 1,

        ]);
        return redirect()->route("user.index")->with("success", "User Add Successfully!");

    }

   

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = Roles::all(); 
        return view("admin.pages.userManage.user.edit", compact('role', 'user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $user = User::findOrFail($id);

    $photo = $user->photo; 

    if ($request->hasFile('photo')) {
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $photo = $request->file('photo')->store('user', 'public');
    }
      $user->update([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'phone'      => $request->phone,
        'role_id'    => $request->role_id,
        'status'     => $request->status,
        'photo'      => $photo ?? $user->photo, 
        ]);
    //   dd($user);
        return redirect()->route('user.index')->with('success', "User Update Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $user = User::find($id);
       if ($user->photo && Storage::disk('public')->exists($user->photo)) {
        Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        
        return redirect()->route("user.index")->with('success', "User Delete Successfully!");
    }
}
