<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SoftwarePlatform;
use App\MetadataSpbe;
use Illuminate\Support\Facades\Validator;

class SoftwarePlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwarePlatforms = SoftwarePlatform::with(['metadataSpbe'])
            ->where('status', 'active')
            ->paginate(10);
            
        return view('master.software_platform.index', compact('softwarePlatforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.software_platform.create', compact('data'));
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
            'nama_perangkat_lunak' => 'required|string|max:255',
            'deskripsi_perangkat_lunak' => 'nullable|string',
            'tipe_perangkat_lunak' => 'required|in:sistem_operasi,sistem_utilitas,sistem_database',
            'jenis_sistem_operasi' => 'nullable|in:dos,unix,macos,windows,networking_os,lainnya',
            'jenis_sistem_utilitas' => 'nullable|string|max:255',
            'jenis_sistem_database' => 'nullable|string|max:255',
            'jenis_lisensi' => 'required|in:lisensi_seumur_hidup,lisensi_periodik,kode_sumber_terbuka',
            'nama_pemilik_lisensi' => 'nullable|string|max:255',
            'validitas_lisensi' => 'nullable|string',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SoftwarePlatform::create($request->all());

        return redirect()->route('master.software_platform.index')
            ->with('success', 'Software Platform berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $softwarePlatform = SoftwarePlatform::with(['metadataSpbe'])->findOrFail($id);
        $data = [
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.software_platform.show', compact('softwarePlatform', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $softwarePlatform = SoftwarePlatform::findOrFail($id);
        $data = [
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.software_platform.edit', compact('softwarePlatform', 'data'));
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
            'nama_perangkat_lunak' => 'required|string|max:255',
            'deskripsi_perangkat_lunak' => 'nullable|string',
            'tipe_perangkat_lunak' => 'required|in:sistem_operasi,sistem_utilitas,sistem_database',
            'jenis_sistem_operasi' => 'nullable|in:dos,unix,macos,windows,networking_os,lainnya',
            'jenis_sistem_utilitas' => 'nullable|string|max:255',
            'jenis_sistem_database' => 'nullable|string|max:255',
            'jenis_lisensi' => 'required|in:lisensi_seumur_hidup,lisensi_periodik,kode_sumber_terbuka',
            'nama_pemilik_lisensi' => 'nullable|string|max:255',
            'validitas_lisensi' => 'nullable|string',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $softwarePlatform = SoftwarePlatform::findOrFail($id);
        $softwarePlatform->update($request->all());

        return redirect()->route('master.software_platform.index')
            ->with('success', 'Software Platform berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softwarePlatform = SoftwarePlatform::findOrFail($id);
        $softwarePlatform->update(['status' => 'inactive']);

        return redirect()->route('master.software_platform.index')
            ->with('success', 'Software Platform berhasil dihapus');
    }
}
