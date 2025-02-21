<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Laptop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data produk dari model Phone
        $phones = Phone::all(); // Ambil semua ponsel
        $laptops = Laptop::all(); // Ambil semua 
        

        return view('dashboard', compact('phones', 'laptops')); // Kirim data ke view
    }
}