<?php

namespace App\Http\Controllers;

use App\MetadataSpbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetadataSpbeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metadataSpbe = MetadataSpbe::orderBy('nama_metadata')->paginate(10);
        return view('master.metadata_spbe.index', compact('metadataSpbe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.metadata_spbe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_metadata' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_metadata' => 'required|string|max:255|unique:metadata_spbe',
            'kategori' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        MetadataSpbe::create($request->all());
        return redirect()->route('master.metadata_spbe.index')->with('success', 'Metadata SPBE berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetadataSpbe $metadataSpbe)
    {
        return view('master.metadata_spbe.show', compact('metadataSpbe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetadataSpbe $metadataSpbe)
    {
        return view('master.metadata_spbe.edit', compact('metadataSpbe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetadataSpbe $metadataSpbe)
    {
        $validator = Validator::make($request->all(), [
            'nama_metadata' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_metadata' => 'required|string|max:255|unique:metadata_spbe,kode_metadata,' . $metadataSpbe->id,
            'kategori' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $metadataSpbe->update($request->all());
        return redirect()->route('master.metadata_spbe.index')->with('success', 'Metadata SPBE berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetadataSpbe $metadataSpbe)
    {
        $metadataSpbe->delete();
        return redirect()->route('master.metadata_spbe.index')->with('success', 'Metadata SPBE berhasil dihapus');
    }
}
