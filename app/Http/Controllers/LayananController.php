<?php

namespace App\Http\Controllers;

use App\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = Layanan::orderBy('nama_layanan')->paginate(10);
        return view('master.layanan.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_layanan' => 'required|string|max:255|unique:layanans',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Layanan::create($request->all());
        return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('master.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('master.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_layanan' => 'required|string|max:255|unique:layanans,kode_layanan,' . $layanan->id,
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $layanan->update($request->all());
        return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}
