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
        // 1. Cek email dan password
        $request->authenticate();

        // 2. Buat sesi baru (keamanan)
        $request->session()->regenerate();

        // 3. LOGIKA REDIRECT CERDAS BERDASARKAN ROLE (Tanpa Intended)
        $role = $request->user()->role;

        if ($role === 'admin' || $role === 'eo') {
            // Paksa masuk ke Dashboard
            return redirect('/admin/events');
        } elseif ($role === 'panitia') {
            // Paksa masuk ke Scanner
            return redirect('/scanner');
        } else {
            // User biasa dilempar ke Halaman Depan
            return redirect('/');
        }
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

