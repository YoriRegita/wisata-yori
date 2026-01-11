<?php

namespace App\Http\Controllers;

use App\Models\Wisata;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWisata = Wisata::count();
        $wisataTerbaru = Wisata::latest()->take(5)->get();

        return view('dashboard', compact('totalWisata', 'wisataTerbaru'));
    }
}
