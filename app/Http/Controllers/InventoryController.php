<?php

namespace App\Http\Controllers;

use App\Document;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Inventory;
use App\Model\Category;
use App\Model\Dbinventory;
use App\Model\InventoryHasLanguage;
use App\Model\InventoryHasService;
use App\Model\Language;
use App\Model\StatusAplikasi;
use App\Opd;
use App\Program;
use App\Servers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class InventoryController extends Controller
{
    private $moduleCode = 'application-inventory';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny', $this->moduleCode);
        $data['moduleCode'] = $this->moduleCode;
        $data['status'] = $request->status;
        $data['opd_id'] = $request->opd_id;
        return view('inventory.application.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inventory $inventory)
    {
        //
        $this->authorize('create', $this->moduleCode);

        $number = Inventory::max('id');
        $desiredLength = 6;
        $data['code'] = 'INV' . date('Ym') . '-' . str_pad($number + 1, $desiredLength, '0', STR_PAD_LEFT);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        $data['programs'] = Program::pluck('name', 'code')->prepend('Select Subunit', '');
        $data['categories'] = Category::pluck('name', 'id')->prepend('Select Kategori', '');
        $data['inventory'] = Inventory::pluck('name', 'id')->prepend('Select Aplikasi', '');
        $data['servers'] = Servers::pluck('ip', 'id')->prepend('Select Server', '');
        $data['databases'] = Dbinventory::pluck('name', 'id')->prepend('Select Database', '');
        $data['languages'] = Language::pluck('name', 'id');
        $data['status_app'] = StatusAplikasi::pluck('name', 'code');
        return view('inventory.application.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryRequest $request, Inventory $inventory)
    {
        $this->authorize('create', $this->moduleCode);
        $inventory->code = $request->code;
        $inventory->name = $request->name;
        $inventory->version = $request->version;
        $inventory->user_base = $request->user_base;
        $inventory->scope = $request->scope;
        $inventory->keterangan = $request->description;
        $inventory->opd_id = $request->opd_id;
        $inventory->category_id = $request->category;
        $inventory->url = $request->url;
        $inventory->tahun_anggaran = $request->tahun_anggaran;
        $inventory->created_by = auth()->user()->id;
        $inventory->created_at = date('Y-m-d H:i:s');
        $inventory->status = $request->status;
        $inventory->platform = $request->platform;
        $inventory->manufacturer = $request->manufacturer;
        $inventory->server_id = $request->server_id;
        $inventory->type_hosting = $request->type_hosting;
        $inventory->predecessor_app = $request->predecessor_app;
        $inventory->service_api = $request->service_api;
        $inventory->endpoint_api = $request->endpoint_api;
        $inventory->sub_unit = $request->sub_unit;
        $inventory->harga = $request->harga;
        $inventory->repository = $request->repository;
        $inventory->database = $request->database;
        $inventory->sumber_dana = $request->sumber_dana;
        $inventory->tahun_pembuatan = $request->tahun_pembuatan;
        $inventory->ip_address = $request->ip_address;
        if ($inventory->save()) {
            $docSpd = $request->doc_spd;
            if ($docSpd) {
                $data = [];
                foreach ($docSpd as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-spd',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docKmk = $request->doc_kmk;
            if ($docKmk) {
                $data = [];
                foreach ($docKmk as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-kmk',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docProbis = $request->doc_probis;
            if ($docProbis) {
                $data = [];
                foreach ($docProbis as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-probis',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docManual = $request->doc_manual;
            if ($docManual) {
                $data = [];
                foreach ($docManual as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-manual',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }

            $docLanguage = $request->language;
            if ($docLanguage) {
                $data = [];
                foreach ($docLanguage as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'language_id' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasLanguage::insert($data);
            }

            $docService = $request->service_name;
            $docServiceData = $request->service_data;
            if ($docService) {
                $data = [];
                foreach ($docService as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'service_name' => $value,
                            'service_data' => $docServiceData[$key],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasService::insert($data);
            }

            return redirect()->route('inventory.application.index')->with('success', 'Tambah Inventory Aplikasi Berhasil.');
        } else {
            return redirect()->route('inventory.application.index')->with('error', 'Tambah Inventory Aplikasi Gagal.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->authorize('view', $this->moduleCode);
        $data['application'] = Inventory::with('category', 'opd', 'program')->where('id', $id)->first();
        $data['moduleCode'] = $this->moduleCode;
        $data['documents'] = Document::select('id', 'inventory', 'url')->where('inventory_id', $id)->get();
        return view('inventory.application.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $number = Inventory::max('id');
        $desiredLength = 6;
        $data['application'] = Inventory::find($id);
        $data['code'] = 'INV' . date('Ym') . '-' . str_pad($number + 1, $desiredLength, '0', STR_PAD_LEFT);
        $data['moduleCode'] = $this->moduleCode;
        $data['opds'] = Opd::pluck('name', 'id')->prepend('Select OPD', '');
        $data['programs'] = Program::pluck('name', 'code')->prepend('Select Subunit', '');
        $data['categories'] = Category::pluck('name', 'id')->prepend('Select Kategori', '');
        $data['inventory'] = Inventory::pluck('name', 'id')->prepend('Select Aplikasi', '');
        $data['documents'] = Document::select('id', 'inventory', 'url')->where('inventory_id', $id)->get();
        $data['servers'] = Servers::pluck('ip', 'id')->prepend('Select Server', '');
        $data['databases'] = Dbinventory::pluck('name', 'id')->prepend('Select Database', '');
        $data['languages'] = Language::pluck('name', 'id');
        $data['language'] = InventoryHasLanguage::select('language_id')->where('inventory_id', $id)->pluck('language_id');
        $data['status_app'] = StatusAplikasi::pluck('name', 'code');
        $data['services'] = InventoryHasService::where('inventory_id', $id)->get();
        return view('inventory.application.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryRequest  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request)
    {
        //
        $this->authorize('update', $this->moduleCode);
        $inventory = Inventory::find($request->id);
        $inventory->code = $request->code;
        $inventory->name = $request->name;
        $inventory->version = $request->version;
        $inventory->user_base = $request->user_base;
        $inventory->scope = $request->scope;
        $inventory->keterangan = $request->description;
        $inventory->opd_id = $request->opd_id;
        $inventory->category_id = $request->category;
        $inventory->url = $request->url;
        $inventory->tahun_anggaran = $request->tahun_anggaran;
        $inventory->updated_by = auth()->user()->id;
        $inventory->updated_at = date('Y-m-d H:i:s');
        $inventory->status = $request->status;
        $inventory->platform = $request->platform;
        $inventory->manufacturer = $request->manufacturer;
        $inventory->server_id = $request->server_id;
        $inventory->type_hosting = $request->type_hosting;
        $inventory->predecessor_app = $request->predecessor_app;
        $inventory->service_api = $request->service_api;
        $inventory->endpoint_api = $request->endpoint_api;
        $inventory->sub_unit = $request->sub_unit;
        $inventory->database = $request->database;
        $inventory->harga = $request->harga;
        $inventory->repository = $request->repository;
        $inventory->sumber_dana = $request->sumber_dana;
        $inventory->tahun_pembuatan = $request->tahun_pembuatan;
        $inventory->ip_address = $request->ip_address;
        if ($inventory->save()) {
            Document::where('inventory_id', $inventory->id)->delete();
            InventoryHasLanguage::where('inventory_id', $inventory->id)->delete();
            InventoryHasService::where('inventory_id', $inventory->id)->delete();
            $docSpd = $request->doc_spd;
            if ($docSpd) {
                $data = [];
                foreach ($docSpd as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-spd',
                            'url' => $value,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docKmk = $request->doc_kmk;
            if ($docKmk) {
                $data = [];
                foreach ($docKmk as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-kmk',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docProbis = $request->doc_probis;
            if ($docProbis) {
                $data = [];
                foreach ($docProbis as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-probis',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }
            $docManual = $request->doc_manual;
            if ($docManual) {
                $data = [];
                foreach ($docManual as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'inventory' => 'application-manual',
                            'url' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    Document::insert($data);
            }

            $docLanguage = $request->language;
            if ($docLanguage) {
                $data = [];
                foreach ($docLanguage as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'language_id' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasLanguage::insert($data);
            }

            $docService = $request->service_name;
            $docServiceData = $request->service_data;
            if ($docService) {
                $data = [];
                foreach ($docService as $key => $value) {
                    if ($value)
                        $data[] = [
                            'inventory_id' => $inventory->id,
                            'service_name' => $value,
                            'service_data' => $docServiceData[$key],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                }
                if ($data)
                    InventoryHasService::insert($data);
            }

            return redirect()->route('inventory.application.index')->with('success', 'Ubah Inventory Aplikasi Berhasil.');
        } else {
            return redirect()->route('inventory.application.index')->with('error', 'Ubah Inventory Aplikasi Gagal.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {
        //
        $this->authorize('delete', $this->moduleCode);
        $model = Inventory::find($request->id);
        $model->delete();
        return response()->json(['success' => true]);
    }


    public function fetch(Request $request): JsonResponse
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $opdId = $request->get("opd_id");
        $status = $request->get("status");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        if ($columnName == 'opd') {
            $columnName = 'opd_id';
        }

        if ($columnName == 'status_text') {
            $columnName = 'status';
        }
        $searchValue = $search_arr['value'];
        $totalRecords = Inventory::count();

        $query = Inventory::select('id', 'code', 'name', 'version', 'scope', 'category_id', 'platform', 'tahun_anggaran', 'status', 'type_hosting', 'manufacturer', 'opd_id', 'url', 'ip_address', 'tahun_pembuatan')
            ->with('category', 'opd', 'statusapp')
            ->where(function ($q) use ($searchValue) {
                return $q->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('url', 'like', '%' . $searchValue . '%')
                    ->orWhere('ip_address', 'like', '%' . $searchValue . '%');
            });

        if ($opdId) {
            $query->where('opd_id', $opdId);
        }

        if ($status) {
            if ($status == 'active') {
                $query->where('status', 'active');
            } else {
                $query->where('status', 'inactive');
            }
        }

        if ($searchValue) {
            $query->orWhereHas('opd', function ($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%');
            });

            $query->orWhereHas('statusapp', function ($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%');
            });
        }

        $totalRecordswithFilter = $query->count();
        $records = $query->skip($start)
            ->take($rowperpage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $data_arr = array();
        $user = auth()->user();
        foreach ($records as $record) {
            if ($record->status == 'active') {
                $status =  '<i class="fa fa-fw fa-circle text-success"></i>';
            } else {
                $status =   '<i class="fa fa-fw fa-circle text-danger"></i>';
            }

            $btn = '<a href="' . route('inventory.application.show', $record->id) . '" data-toggle="tooltip" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
            if ($user->can('edit', $this->moduleCode) == 1) {
                $btn .= '<a href="' . route('inventory.application.edit', $record->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
            }
            if ($user->can('delete', $this->moduleCode) == 1) {
                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $record->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
            }

            $data_arr[] = array(
                'id' => $record->id,
                'code' => $record->code,
                'name' => $record->name,
                'version' => $record->version,
                'scope' => $record->scope,
                'category_id' => $record->category_id,
                'platform' => $record->platform,
                'tahun_anggaran' => $record->tahun_anggaran,
                'status' => $status,
                'type_hosting' => $record->type_hosting,
                'manufacturer' => $record->manufacturer,
                'opd_id' => $record->opd_id,
                'url' => '<a href="https://' . $record->url . '" target="_blank">' . $record->url . '</a>' ?? '-',
                'ip_address' => $record->ip_address,
                'tahun_pembuatan' => $record->tahun_pembuatan,
                'category' => $record->category->name ?? '-',
                'opd' => $record->opd->name ?? '-',
                'status_text' => $record->statusapp->name ?? '-',
                'action' => $btn
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        return response()->json($response);
    }
}
