<?php

namespace App\Http\Controllers;

use App\Http\Resources\KategoriResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = \App\Models\Kategori::query();
    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama_kategori', 'LIKE', "%{$search}%");
    }
    
    $kategoris = $query->get();
    return response()->json(['data' => $kategoris]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = \App\Models\Kategori::create($validated);
        return new KategoriResource($kategori);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return new KategoriResource($kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori->update($validated);
        return new KategoriResource($kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['message' => 'Kategori deleted successfully'], 200);
    }
}
