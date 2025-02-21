<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Laptop;
use App\Models\Accessory;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        $phones = Phone::where('name', 'LIKE', "%$query%")->get();
        $laptops = Laptop::where('name', 'LIKE', "%$query%")->get();
        $accessories = Accessory::where('name', 'LIKE', "%$query%")->get();

        return view('search.results', compact('phones', 'laptops', 'accessories', 'query'));
    }
}
