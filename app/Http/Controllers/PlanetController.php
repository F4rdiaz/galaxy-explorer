<?php

namespace App\Http\Controllers;

use App\Models\Planet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlanetController extends Controller
{
    public function index()
    {
        $planets = Planet::all();
        return view('planets.index', compact('planets'));
    }

    public function create()
    {
        return view('planets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'jarak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('planet_images', 'public');
        }

        Planet::create($validated);

        return redirect()->route('planets.index')->with('success', 'Planet berhasil ditambahkan!');
    }

    public function show(Planet $planet)
    {
        return view('planets.show', compact('planet'));
    }

    public function edit(Planet $planet)
    {
        return view('planets.edit', compact('planet'));
    }

    public function update(Request $request, Planet $planet)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'jarak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($planet->gambar) {
                Storage::disk('public')->delete($planet->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('planet_images', 'public');
        }

        $planet->update($validated);

        return redirect()->route('planets.index')->with('success', 'Planet berhasil diperbarui!');
    }

    public function destroy(Planet $planet)
    {
        if ($planet->gambar) {
            Storage::disk('public')->delete($planet->gambar);
        }

        $planet->delete();

        return redirect()->route('planets.index')->with('success', 'Planet berhasil dihapus!');
    }
}
