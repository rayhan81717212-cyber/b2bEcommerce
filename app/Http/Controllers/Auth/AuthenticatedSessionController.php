<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        if ($user->role_id == 1) {
            return redirect('/admin/dashboard');
        }

        if ($user->role_id == 2) {
            if ($user->vendor_status == 0) {
                auth()->logout();
                return redirect('/login')->with('error', 'Your account is pending approval. Please wait for admin confirmation.');
            }

            return redirect('/vendor/dashboard');
        }

        if ($user->role_id == 4) {
            return redirect('/customers/dashboard');
        }

        return redirect('/');
    }


    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
