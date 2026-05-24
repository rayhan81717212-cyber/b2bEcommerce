<?php

namespace App\Http\Controllers\SiteController;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // insert Data


    public function index()
    {
        $user_id = auth()->user()->id;

        $customers = User::from('users as u')
            ->select('u.first_name', 'u.last_name', 'u.email', 'c.phone', 'c.address', 'c.city', 'c.country', 'c.postal_code', 'c.profile_image', 'c.status')
            ->leftJoin('customers as c', 'c.user_id', '=', 'u.id')
            ->where('u.id', $user_id)
            ->get();

        return view('customersDashboard.pages.profile.index', compact('customers'));
    }

    public function create()
    {
        $user_id = auth()->id();

        $customer = Customer::join('users', 'customers.user_id', '=', 'users.id')
        ->select(
            'customers.*',
            'users.first_name',
            'users.last_name'
        )
        ->where('customers.user_id', auth()->id())
        ->first();

        return view('customersDashboard.pages.profile.profileUpdate', compact('customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user_id = auth()->id();

        $customer = Customer::where('user_id', $user_id)->first();

        // old image
        $imagePath = $customer->profile_image ?? null;

        // new image upload
        if ($request->hasFile('profile_image')) {

            if ($customer && $customer->profile_image) {
                $oldPath = public_path('storage/' . $customer->profile_image);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $imagePath = $request->file('profile_image')->store('customers', 'public');
        }
        
        // user update
        User::where('id', $user_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        // customers update
        Customer::updateOrCreate(
            ['user_id' => $user_id],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
                'profile_image' => $imagePath,
            ]
        );

        return redirect()->route('customers-profile')->with('success', 'Profile saved successfully!');
    }
}
