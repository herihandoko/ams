<?php

namespace App\Http\Controllers;

use App\DataMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataMetadataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMetadata = DataMetadata::orderBy('nama_data')->paginate(10);
        return view('master.data_metadata.index', compact('dataMetadata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.data_metadata.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_data' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_data' => 'required|string|max:255|unique:data_metadata',
            'tipe_data' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DataMetadata::create($request->all());
        return redirect()->route('master.data_metadata.index')->with('success', 'Data Metadata berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataMetadata $dataMetadata)
    {
        return view('master.data_metadata.show', compact('dataMetadata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataMetadata $dataMetadata)
    {
        return view('master.data_metadata.edit', compact('dataMetadata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataMetadata $dataMetadata)
    {
        $validator = Validator::make($request->all(), [
            'nama_data' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kode_data' => 'required|string|max:255|unique:data_metadata,kode_data,' . $dataMetadata->id,
            'tipe_data' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataMetadata->update($request->all());
        return redirect()->route('master.data_metadata.index')->with('success', 'Data Metadata berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataMetadata $dataMetadata)
    {
        $dataMetadata->delete();
        return redirect()->route('master.data_metadata.index')->with('success', 'Data Metadata berhasil dihapus');
    }
}
