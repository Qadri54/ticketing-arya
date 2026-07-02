<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Memeriksa apakah role pengguna sesuai dengan yang diizinkan (admin, eo, panitia, user).
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Jika belum login, suruh login dulu
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Cek apakah role pengguna yang sedang login ada di daftar yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request); // Silakan masuk
        }

        // 3. Jika role tidak cocok, tampilkan halaman Error 403 (Dilarang Masuk)
        return abort(403, 'Akses Ditolak. Akun Anda tidak memiliki izin untuk halaman ini.');
    }
}
