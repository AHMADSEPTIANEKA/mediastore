<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaptopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $laptops = Laptop::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('brand', 'like', "%$search%")
                         ->orWhere('type', 'like', "%$search%")
                         ->orWhere('price', 'like', "%$search%");
        })->paginate(4);

        return view('laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('laptops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'processor' => 'nullable|string',
            'ram' => 'nullable|integer',
            'storage' => 'nullable|integer',
            'screen_size' => 'nullable|string',
            'battery_life' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('laptops', 'public');
        }

        Laptop::create($data);

        return redirect()->route('laptops.index')->with('success', 'Laptop added successfully!');
    }

    public function show(string $id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('laptops.show', compact('laptop'));
    }

    public function edit(string $id)
    {
        $laptop = Laptop::findOrFail($id);
        return view('laptops.edit', compact('laptop'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'processor' => 'nullable|string',
            'ram' => 'nullable|integer',
            'storage' => 'nullable|integer',
            'screen_size' => 'nullable|string',
            'battery_life' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
        ]);

        $laptop = Laptop::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($laptop->picture) {
                Storage::disk('public')->delete($laptop->picture);
            }
            $data['picture'] = $request->file('picture')->store('laptops', 'public');
        }

        $laptop->update($data);

        return redirect()->route('laptops.index')->with('success', 'Laptop updated successfully!');
    }

    public function destroy(string $id)
    {
        $laptop = Laptop::findOrFail($id);

        // Hapus gambar jika ada
        if ($laptop->picture) {
            Storage::disk('public')->delete($laptop->picture);
        }

        // Hapus data dari database
        $laptop->delete();

        return redirect()->route('laptops.index')->with('success', 'Laptop deleted successfully!');
    }


    public function gaming()
    {
        $laptops = Laptop::where('type', 'gaming')->paginate(10);
        return view('laptops.gaming', compact('laptops'));
    }

    public function ultrabook()
    {
        $laptops = Laptop::where('type', 'ultrabook')->paginate(10);
        return view('laptops.ultrabook', compact('laptops'));
    }

    public function workstation()
    {
        $laptops = Laptop::where('type', 'workstation')->paginate(10);
        return view('laptops.workstation', compact('laptops'));
    }
} 