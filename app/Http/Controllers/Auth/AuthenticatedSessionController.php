<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
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

        // Check if the authenticated user is an admin
        if (Auth::user()->role !== 'admin') {
            Auth::guard('web')->logout();  // Log out the non-admin user
            $request->session()->invalidate();  // Invalidate the session
            $request->session()->regenerateToken();  // Regenerate CSRF token

            // Redirect the user to the login page with an error message
            return redirect()->route('login')->withErrors(['email' => 'You do not have admin access.']);
        }

        $request->session()->regenerate();

        // Redirect to the intended route
        return redirect()->intended(RouteServiceProvider::HOME);
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
