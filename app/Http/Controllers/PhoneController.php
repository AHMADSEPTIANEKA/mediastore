<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use Illuminate\Support\Facades\Storage;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $phones = Phone::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('brand', 'like', "%$search%")
                         ->orWhere('type', 'like', "%$search%")
                         ->orWhere('price', 'like', "%$search%");
        })->paginate(4);

        return view('phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('phones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|in:Android,iPhone',
            'price' => 'required|numeric|min:0',
            'camera_main' => 'nullable|string',
            'camera_ultra' => 'nullable|string',
            'camera_front' => 'nullable|string',
            'screen_size' => 'nullable|numeric',
            'screen_resolution' => 'nullable|string',
            'refresh_rate' => 'nullable|numeric',
            'processor' => 'nullable|string',
            'battery_capacity' => 'nullable|numeric',
            'charging_speed' => 'nullable|numeric',
            'ip_rating' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('phones', 'public');
        }

        Phone::create($data);

        return redirect()->route('phones.index')->with('success', 'Phone added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $phone = Phone::findOrFail($id);
        return view('phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phone = Phone::findOrFail($id);
        return view('phones.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'camera_main' => 'nullable|string',
            'camera_ultra' => 'nullable|string',
            'camera_front' => 'nullable|string',
            'screen_size' => 'nullable|numeric',
            'screen_resolution' => 'nullable|string',
            'refresh_rate' => 'nullable|numeric',
            'processor' => 'nullable|string',
            'battery_capacity' => 'nullable|numeric',
            'charging_speed' => 'nullable|numeric',
            'ip_rating' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
        ]);

        $phone = Phone::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('phones', 'public');
        }

        $phone->update($data);

        return redirect()->route('phones.index')->with('success', 'Phone updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phone = Phone::findOrFail($id);

        // Hapus gambar jika ada
        if ($phone->picture) {
            Storage::disk('public')->delete($phone->picture);
        }

        // Hapus data dari database
        $phone->delete();

        return redirect()->route('phones.index')->with('success', 'Phone deleted successfully!');
    }

    public function android()
    {
        $phones = Phone::where('type', 'Android')->paginate(10);
        return view('phones.android', compact('phones'));
    }

    public function iphone()
    {
        $phones = Phone::where('type', 'iPhone')->paginate(10);
        return view('phones.iphone', compact('phones'));
    }
}
