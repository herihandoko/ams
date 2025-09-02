<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Servers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ServersController extends Controller
{
    private $moduleCode = 'servers';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $this->authorize('viewAny', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        return view('master.servers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        //
        $this->authorize('create', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['hardware'] = Hardware::pluck('inventory_tag', 'id')->prepend('Select Hardware', '');
        $data['units'] = \App\Unit::where('status', 'aktif')->pluck('nama_unit', 'id')->prepend('Pilih Unit', '');
        $data['metadata_spbe'] = \App\MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')->prepend('Pilih Metadata SPBE', '');
        $data['software_platforms'] = \App\SoftwarePlatform::where('status', 'active')->pluck('nama_perangkat_lunak', 'id')->prepend('Pilih Software Platform', '');
        return view('master.servers.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $this->authorize('create', $this->moduleCode);
        $validator = Validator::make($request->all(), [
            'ip' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = new Servers();
        $model->type = $request->type;
        $model->ip = $request->ip;
        $model->id_hardware = $request->id_hardware;
        $model->hdd = $request->hdd;
        $model->ram = $request->ram;
        $model->cpu = $request->cpu;
        $model->status = $request->status;
        $model->service = $request->service;
        
        // Field baru
        $model->nama_server = $request->nama_server;
        $model->deskripsi_server = $request->deskripsi_server;
        $model->jenis_penggunaan_server = $request->jenis_penggunaan_server;
        $model->status_kepemilikan = $request->status_kepemilikan;
        $model->nama_pemilik = $request->nama_pemilik;
        $model->unit_pengelola_id = $request->unit_pengelola_id;
        $model->lokasi_fasilitas_id = $request->lokasi_fasilitas_id;
        $model->perangkat_lunak_id = $request->perangkat_lunak_id;
        $model->jenis_teknologi_prosesor = $request->jenis_teknologi_prosesor;
        $model->teknik_penyimpanan = $request->teknik_penyimpanan;
        $model->id_metadata_terkait = $request->id_metadata_terkait;
        
        $model->created_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.servers.index')->with('success', 'Tambah Kategori Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        //
        $this->authorize('view', $this->moduleCode);
        $data['servers'] = Servers::with('hardware')->where('id', $id)->first();
        return view('master.servers.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        //
        $this->authorize('update', $this->moduleCode);
        $data['servers'] = Servers::find($id);
        $data['hardware'] = Hardware::pluck('inventory_tag', 'id')->prepend('Select Hardware', '');
        $data['units'] = \App\Unit::where('status', 'aktif')->pluck('nama_unit', 'id')->prepend('Pilih Unit', '');
        $data['metadata_spbe'] = \App\MetadataSpbe::where('status', 'aktif')->pluck('nama_metadata', 'id')->prepend('Pilih Metadata SPBE', '');
        $data['software_platforms'] = \App\SoftwarePlatform::where('status', 'active')->pluck('nama_perangkat_lunak', 'id')->prepend('Pilih Software Platform', '');
        return view('master.servers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): RedirectResponse
    {
        //
        $this->authorize('update', $this->moduleCode);
        $validator = Validator::make($request->all(), [
            'ip' => 'required|max:255|unique:servers,ip,' . $request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $model = Servers::find($request->id);
        $model->type = $request->type;
        $model->ip = $request->ip;
        $model->id_hardware = $request->id_hardware;
        $model->hdd = $request->hdd;
        $model->ram = $request->ram;
        $model->cpu = $request->cpu;
        $model->status = $request->status;
        $model->service = $request->service;
        
        // Field baru
        $model->nama_server = $request->nama_server;
        $model->deskripsi_server = $request->deskripsi_server;
        $model->jenis_penggunaan_server = $request->jenis_penggunaan_server;
        $model->status_kepemilikan = $request->status_kepemilikan;
        $model->nama_pemilik = $request->nama_pemilik;
        $model->unit_pengelola_id = $request->unit_pengelola_id;
        $model->lokasi_fasilitas_id = $request->lokasi_fasilitas_id;
        $model->perangkat_lunak_id = $request->perangkat_lunak_id;
        $model->jenis_teknologi_prosesor = $request->jenis_teknologi_prosesor;
        $model->teknik_penyimpanan = $request->teknik_penyimpanan;
        $model->id_metadata_terkait = $request->id_metadata_terkait;
        
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        return redirect()->route('master.servers.index')->with('success', 'Update Server Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        //
        $this->authorize('delete', $this->moduleCode);
        $model = Servers::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request): JsonResponse
    {
        $this->authorize('viewAny', $this->moduleCode);
        $user = Auth::user();
        $data = Servers::select([
            'id', 'ip', 'type', 'id_hardware', 'hdd', 'ram', 'cpu', 'service', 'status',
            'nama_server', 'deskripsi_server', 'jenis_penggunaan_server', 'status_kepemilikan',
            'nama_pemilik', 'unit_pengelola_id', 'lokasi_fasilitas_id', 'perangkat_lunak_id',
            'jenis_teknologi_prosesor', 'teknik_penyimpanan', 'id_metadata_terkait'
        ])->with(['hardware', 'unitPengelola', 'lokasiFasilitas', 'perangkatLunak', 'metadataSpbe']);
        // Debug: Log the first server data to see what's being sent
        \Log::info('First server data:', [
            'id' => $data->first()?->id,
            'nama_server' => $data->first()?->nama_server,
            'ip' => $data->first()?->ip,
            'jenis_penggunaan_server' => $data->first()?->jenis_penggunaan_server
        ]);
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_server', function ($row) {
                return $row->nama_server ?: '-';
            })
            ->addColumn('hardware', function ($row) {
                return $row->hardware ? $row->hardware->inventory_tag : '-';
            })
            ->addColumn('unit_pengelola', function ($row) {
                return $row->unitPengelola ? $row->unitPengelola->nama_unit : '-';
            })
            ->addColumn('jenis_penggunaan_server', function ($row) {
                if (!$row->jenis_penggunaan_server) return '-';
                
                $jenis = [
                    'web_server' => 'Web Server',
                    'mail_server' => 'Mail Server',
                    'aplikasi' => 'Aplikasi',
                    'database' => 'Database',
                    'file_server' => 'File Server',
                    'active_directory' => 'Active Directory',
                    'keamanan_informasi' => 'Keamanan Informasi',
                ];
                return $jenis[$row->jenis_penggunaan_server] ?? $row->jenis_penggunaan_server;
            })
            ->addColumn('status_kepemilikan', function ($row) {
                if (!$row->status_kepemilikan) return '-';
                
                $status = [
                    'milik_sendiri' => 'Milik Sendiri',
                    'milik_instansi_pemerintah_lain' => 'Milik Instansi Pemerintah Lain',
                    'milik_bumn' => 'Milik BUMN',
                    'milik_pihak_ketiga' => 'Milik Pihak Ketiga',
                ];
                return $status[$row->status_kepemilikan] ?? $row->status_kepemilikan;
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'active') {
                    return '<i class="fa fa-fw fa-circle text-success"></i>';
                } else {
                    return '<i class="fa fa-fw fa-circle text-danger"></i>';
                }
            })
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="' . route('master.servers.show', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="' . route('master.servers.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
                }
                if ($user->can('delete', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('ip', 'LIKE', "%" . Str::lower($search['value']) . "%");
                        $w->orWhere('nama_server', 'LIKE', "%" . Str::lower($search['value']) . "%");
                    });
                }
            })
            ->rawColumns(['action', 'status', 'hardware'])
            ->make(true);
    }
}
