<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Sponsorship;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Event
        $query = Event::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        if ($request->has('location') && $request->location != '') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $events = $query->latest()->get();

        // 2. Ambil data Sponsorship beserta relasi event-nya
        $sponsorships = Sponsorship::with('event')->latest()->get();

        // 3. Kirim kedua variabel ke file welcome.blade.php
        return view('welcome', compact('events', 'sponsorships'));
    }
}
