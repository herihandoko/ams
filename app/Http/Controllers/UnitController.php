<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::orderBy('nama_unit')->paginate(10);
        return view('master.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_unit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_unit' => 'required|string|max:255|unique:units',
            'tipe_unit' => 'required|in:pengembang,operasional,keduanya',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Unit::create($request->all());
        return redirect()->route('master.unit.index')->with('success', 'Unit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('master.unit.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('master.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $validator = Validator::make($request->all(), [
            'nama_unit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_unit' => 'required|string|max:255|unique:units,kode_unit,' . $unit->id,
            'tipe_unit' => 'required|in:pengembang,operasional,keduanya',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $unit->update($request->all());
        return redirect()->route('master.unit.index')->with('success', 'Unit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('master.unit.index')->with('success', 'Unit berhasil dihapus');
    }
}
