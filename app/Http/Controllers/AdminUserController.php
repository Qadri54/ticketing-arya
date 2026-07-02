<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    // 1. Tampilkan semua daftar pengguna di platform
    public function index()
    {
        // Mengambil seluruh user, urutkan dari yang paling baru mendaftar
        $users = User::latest()->get();
        
        return view('admin.users.index', compact('users'));
    }

    // 2. Aksi hapus akun pengguna jika melanggar ketentuan
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah admin menghapus akunnya sendiri secara tidak sengaja
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Gagal! Kamu tidak bisa menghapus akun kamu sendiri yang sedang digunakan.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil dihapus dari sistem!');
    }
}