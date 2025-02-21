<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessory;
use Illuminate\Support\Facades\Storage;

class AccessoryController extends Controller
{
    /**
     * Tampilkan daftar accessories.
     */
    public function index()
    {
        $accessories = Accessory::paginate(10);
        return view('accessories.index', compact('accessories'));
    }

    

    /**
     * Tampilkan form tambah accessory.
     */
    public function create()
    {
        return view('accessories.create');
    }

    /**
     * Simpan data accessory ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('picture')) {
            $validatedData['picture'] = $request->file('picture')->store('accessories', 'public');
        }

        Accessory::create($validatedData);

        return redirect()->route('accessories.index')->with('success', 'Accessory added successfully.');
    }

    /**
     * Tampilkan detail accessory.
     */
    public function show(Accessory $accessory)
    {
        return view('accessories.show', compact('accessory'));
    }

    /**
     * Tampilkan form edit accessory.
     */
    public function edit(Accessory $accessory)
    {
        return view('accessories.edit', compact('accessory'));
    }

    /**
     * Update data accessory di database.
     */
    public function update(Request $request, Accessory $accessory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        // Jika ada file gambar baru, hapus yang lama
        if ($request->hasFile('picture')) {
            if ($accessory->picture) {
                Storage::disk('public')->delete($accessory->picture);
            }
            $validatedData['picture'] = $request->file('picture')->store('accessories', 'public');
        } else {
            $validatedData['picture'] = $accessory->picture;
        }

        $accessory->update($validatedData);

        return redirect()->route('accessories.index')->with('success', 'Accessory updated successfully.');
    }

    /**
     * Hapus accessory dari database.
     */
    public function destroy(Accessory $accessory)
    {
        if ($accessory->picture) {
            Storage::disk('public')->delete($accessory->picture);
        }

        $accessory->delete();

        return redirect()->route('accessories.index')->with('success', 'Accessory deleted successfully.');
    }

    /**
     * Tampilkan halaman home accessories.
     */
    public function home()
    {
        $accessories = Accessory::all();
        return view('accessories.home', compact('accessories'));
    }
}
