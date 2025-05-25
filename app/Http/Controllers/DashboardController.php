<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Phone;
use App\Models\Laptop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $phones = Phone::all();
    $laptops = Laptop::all();
    $accessories = Accessory::all(); // gunakan huruf kecil

    return view('dashboard', compact('phones', 'laptops', 'accessories'));
}

    public function admin() {
    $phones = Phone::all();
    $laptops = Laptop::all();
    $accessories = Accessory::all();

    return view('dashboard.admin', compact('phones', 'laptops', 'accessories'));
}

public function user() {
    $phones = Phone::all();
    $laptops = Laptop::all();
    $accessories = Accessory::all();

    return view('dashboard.user', compact('phones', 'laptops', 'accessories'));
}



}