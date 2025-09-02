<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StorageMedia;
use App\DataMetadata;
use App\Unit;
use App\MetadataSpbe;
use App\SoftwarePlatform;
use Illuminate\Support\Facades\Validator;

class StorageMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storageMedia = StorageMedia::with(['dataYangDigunakan', 'unitPengelola', 'lokasiDataStorage', 'perangkatLunak', 'metadataSpbe'])
            ->where('status', 'active')
            ->paginate(10);
            
        return view('master.storage_media.index', compact('storageMedia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'data_metadata' => DataMetadata::where('status', 'aktif')->pluck('nama_data', 'id'),
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id'),
            'software_platforms' => SoftwarePlatform::where('status', 'active')->pluck('nama_perangkat_lunak', 'id')
        ];
        
        return view('master.storage_media.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_data_storage' => 'required|string|max:255',
            'deskripsi_data_storage' => 'nullable|string',
            'data_yang_digunakan_id' => 'nullable|exists:data_metadata,id',
            'status_kepemilikan' => 'required|in:milik_sendiri,milik_instansi_pemerintah_lain,milik_bumn,milik_pihak_ketiga',
            'nama_pemilik' => 'nullable|string|max:255',
            'unit_pengelola_id' => 'nullable|exists:units,id',
            'lokasi_data_storage_id' => 'nullable|exists:metadata_spbe,id',
            'perangkat_lunak_id' => 'nullable|exists:software_platforms,id',
            'kapasitas_penyimpanan' => 'required|integer|min:1',
            'metode_akses_data_sharing' => 'required|in:das,nas',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        StorageMedia::create($request->all());

        return redirect()->route('master.storage_media.index')
            ->with('success', 'Storage Media berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storageMedia = StorageMedia::with(['dataYangDigunakan', 'unitPengelola', 'lokasiDataStorage', 'perangkatLunak', 'metadataSpbe'])->findOrFail($id);
        $data = [
            'data_metadata' => DataMetadata::where('status', 'aktif')->pluck('nama_data', 'id'),
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id'),
            'software_platforms' => SoftwarePlatform::where('status', 'active')->pluck('nama_perangkat_lunak', 'id')
        ];
        
        return view('master.storage_media.show', compact('storageMedia', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storageMedia = StorageMedia::findOrFail($id);
        $data = [
            'data_metadata' => DataMetadata::where('status', 'aktif')->pluck('nama_data', 'id'),
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id'),
            'software_platforms' => SoftwarePlatform::where('status', 'active')->pluck('nama_perangkat_lunak', 'id')
        ];
        
        return view('master.storage_media.edit', compact('storageMedia', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_data_storage' => 'required|string|max:255',
            'deskripsi_data_storage' => 'nullable|string',
            'data_yang_digunakan_id' => 'nullable|exists:data_metadata,id',
            'status_kepemilikan' => 'required|in:milik_sendiri,milik_instansi_pemerintah_lain,milik_bumn,milik_pihak_ketiga',
            'nama_pemilik' => 'nullable|string|max:255',
            'unit_pengelola_id' => 'nullable|exists:units,id',
            'lokasi_data_storage_id' => 'nullable|exists:metadata_spbe,id',
            'perangkat_lunak_id' => 'nullable|exists:software_platforms,id',
            'kapasitas_penyimpanan' => 'required|integer|min:1',
            'metode_akses_data_sharing' => 'required|in:das,nas',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $storageMedia = StorageMedia::findOrFail($id);
        $storageMedia->update($request->all());

        return redirect()->route('master.storage_media.index')
            ->with('success', 'Storage Media berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storageMedia = StorageMedia::findOrFail($id);
        $storageMedia->update(['status' => 'inactive']);

        return redirect()->route('master.storage_media.index')
            ->with('success', 'Storage Media berhasil dihapus');
    }
}
