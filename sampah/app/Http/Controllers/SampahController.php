<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $query = \App\Models\Sampah::with('kategori');
    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama', 'LIKE', "%{$search}%");
    }
    
    $sampahs = $query->get();
    return response()->json($sampahs);
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
            'nama' => 'required|string|max:255',
            'berat' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $sampah = \App\Models\Sampah::create($validated);
        return new \App\Http\Resources\SampahResource($sampah);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sampah = \App\Models\Sampah::with('kategori')->findOrFail($id);
        return new \App\Http\Resources\SampahResource($sampah);
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
        $sampah = \App\Models\Sampah::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'berat' => 'required|numeric',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        $sampah->update($validated);
        return new \App\Http\Resources\SampahResource($sampah);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sampah = \App\Models\Sampah::findOrFail($id);
        $sampah->delete();

        return response()->json(['message' => 'Sampah deleted successfully'], 200);
    }
}
