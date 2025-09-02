<?php

namespace App\Http\Controllers;

use App\GovernmentCloud;
use App\Unit;
use App\MetadataSpbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GovernmentCloudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governmentClouds = GovernmentCloud::with(['unitPengembang', 'unitOperasional', 'metadataSpbe'])
            ->where('status', 'active')
            ->paginate(10);
            
        return view('master.government_cloud.index', compact('governmentClouds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.government_cloud.create', compact('data'));
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
            'nama_government_cloud' => 'required|string|max:255',
            'deskripsi_government_cloud' => 'nullable|string',
            'tipe_government_cloud' => 'required|in:paas,iaas,saas,bdaas,secaas',
            'status_kepemilikan' => 'required|in:milik_sendiri,milik_instansi_pemerintah_lain,milik_bumn,milik_pihak_ketiga',
            'nama_pemilik' => 'nullable|string|max:255',
            'biaya_layanan' => 'nullable|numeric|min:0',
            'unit_pengembang_id' => 'nullable|exists:units,id',
            'unit_operasional_id' => 'nullable|exists:units,id',
            'jangka_waktu_pelayanan' => 'nullable|string|max:255',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        GovernmentCloud::create($request->all());

        return redirect()->route('master.government_cloud.index')
            ->with('success', 'Government Cloud berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $governmentCloud = GovernmentCloud::with(['unitPengembang', 'unitOperasional', 'metadataSpbe'])->findOrFail($id);
        $data = [
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.government_cloud.show', compact('governmentCloud', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $governmentCloud = GovernmentCloud::findOrFail($id);
        $data = [
            'units' => Unit::where('status', 'aktif')->pluck('nama_unit', 'id'),
            'metadata_spbe' => MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')
        ];
        
        return view('master.government_cloud.edit', compact('governmentCloud', 'data'));
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
            'nama_government_cloud' => 'required|string|max:255',
            'deskripsi_government_cloud' => 'nullable|string',
            'tipe_government_cloud' => 'required|in:paas,iaas,saas,bdaas,secaas',
            'status_kepemilikan' => 'required|in:milik_sendiri,milik_instansi_pemerintah_lain,milik_bumn,milik_pihak_ketiga',
            'nama_pemilik' => 'nullable|string|max:255',
            'biaya_layanan' => 'nullable|numeric|min:0',
            'unit_pengembang_id' => 'nullable|exists:units,id',
            'unit_operasional_id' => 'nullable|exists:units,id',
            'jangka_waktu_pelayanan' => 'nullable|string|max:255',
            'id_metadata_terkait' => 'nullable|exists:metadata_spbe,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $governmentCloud = GovernmentCloud::findOrFail($id);
        $governmentCloud->update($request->all());

        return redirect()->route('master.government_cloud.index')
            ->with('success', 'Government Cloud berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governmentCloud = GovernmentCloud::findOrFail($id);
        $governmentCloud->update(['status' => 'inactive']);

        return redirect()->route('master.government_cloud.index')
            ->with('success', 'Government Cloud berhasil dihapus');
    }
}
