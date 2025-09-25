@extends('page')
@section('title', 'Application')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Inventory</a></li>
        <li class="active">Aplikasi</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Aplikasi <small>List</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        @can('create', $data['moduleCode'])
                            <a href="{{ route('inventory.application.create') }}"
                                class="btn btn-xs btn-icon btn-circle btn-primary btn-action-add"><i class="fa fa-plus"></i></a>
                        @endcan
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Aplikasi - list</h4>
                </div>
                <div class="panel-body">
                    @include('master.message')
                    
                    <!-- Filter Section -->
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                                            <i class="fa fa-filter"></i> Filter Data
                                        </a>
                                    </h4>
                                </div>
                                <div id="filterCollapse" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <form method="GET" action="{{ route('inventory.application.index') }}">
                                            <div class="row">
                                                @if(auth()->user()->opd_id)
                                                    {{-- Jika user memiliki OPD, sembunyikan filter OPD --}}
                                                    <input type="hidden" name="opd_id" value="{{ auth()->user()->opd_id }}">
                                                @else
                                                    {{-- Jika user tidak memiliki OPD, tampilkan filter OPD --}}
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="filter_opd">OPD</label>
                                                            <select class="form-control" id="filter_opd" name="opd_id">
                                                                @foreach($data['opds'] as $id => $opd)
                                                                    <option value="{{ $id }}" {{ $data['opd_id'] == $id ? 'selected' : '' }}>{{ $opd }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_status">Status</label>
                                                        <select class="form-control" id="filter_status" name="status">
                                                            <option value="active" {{ $data['status'] == 'active' || $data['status'] == '' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="inactive" {{ $data['status'] == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_category">Kategori</label>
                                                        <select class="form-control" id="filter_category" name="category_id">
                                                            @foreach($data['categories'] as $id => $category)
                                                                <option value="{{ $id }}" {{ $data['category_id'] == $id ? 'selected' : '' }}>{{ $category }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_layanan">Layanan</label>
                                                        <select class="form-control" id="filter_layanan" name="id_layanan">
                                                            @foreach($data['layanans'] as $id => $layanan)
                                                                <option value="{{ $id }}" {{ $data['id_layanan'] == $id ? 'selected' : '' }}>{{ $layanan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_unit_pengembang">Unit Pengembang</label>
                                                        <select class="form-control" id="filter_unit_pengembang" name="unit_pengembang">
                                                            @foreach($data['units'] as $id => $unit)
                                                                <option value="{{ $id }}" {{ $data['unit_pengembang'] == $id ? 'selected' : '' }}>{{ $unit }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_tahun_pembuatan">Tahun Pembuatan</label>
                                                        <select class="form-control" id="filter_tahun_pembuatan" name="tahun_pembuatan">
                                                            <option value="">Semua Tahun</option>
                                                            @for($year = date('Y'); $year >= 2010; $year--)
                                                                <option value="{{ $year }}" {{ $data['tahun_pembuatan'] == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_platform">Platform</label>
                                                        <select class="form-control" id="filter_platform" name="platform">
                                                            <option value="">Semua Platform</option>
                                                            <option value="Web" {{ $data['platform'] == 'Web' ? 'selected' : '' }}>Web</option>
                                                            <option value="Mobile" {{ $data['platform'] == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                                                            <option value="Desktop" {{ $data['platform'] == 'Desktop' ? 'selected' : '' }}>Desktop</option>
                                                            <option value="Hybrid" {{ $data['platform'] == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="filter_type_hosting">Type Hosting</label>
                                                        <select class="form-control" id="filter_type_hosting" name="type_hosting">
                                                            <option value="">Semua Type Hosting</option>
                                                            <option value="On-Premise" {{ $data['type_hosting'] == 'On-Premise' ? 'selected' : '' }}>On-Premise</option>
                                                            <option value="Cloud" {{ $data['type_hosting'] == 'Cloud' ? 'selected' : '' }}>Cloud</option>
                                                            <option value="Hybrid" {{ $data['type_hosting'] == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="search">Pencarian</label>
                                                        <input type="text" class="form-control" id="search" name="search" value="{{ $data['search'] }}" placeholder="Cari nama aplikasi, URL, atau IP...">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <div>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Terapkan Filter
                                                            </button>
                                                            <a href="{{ route('inventory.application.index') }}" class="btn btn-default">
                                                                <i class="fa fa-refresh"></i> Reset Filter
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="32">#</th>
                                <th>ID</th>
                                <th>Nama Aplikasi</th>
                                <th>Tahun</th>
                                <th>DNS</th>
                                <th>OPD</th>
                                <th>IP</th>
                                <th>Type Layanan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse($data['inventories'] as $index => $inventory)
                                    <tr>
                                        <td>
                                            @if($inventory->status == 'active')
                                                <i class="fa fa-fw fa-circle text-success"></i>
                                            @else
                                                <i class="fa fa-fw fa-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->tahun_pembuatan }}</td>
                                        <td>
                                            @if($inventory->url)
                                                <a href="https://{{ $inventory->url }}" target="_blank">{{ $inventory->url }}</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $inventory->opd->name ?? '-' }}</td>
                                        <td>{{ $inventory->ip_address ?? '-' }}</td>
                                        <td>{{ $inventory->scope ?? '-' }}</td>
                                        <td>{{ $inventory->statusapp->name ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('inventory.application.show', $inventory->id) }}" 
                                               data-toggle="tooltip" data-original-title="View" 
                                               class="btn btn-xs btn-icon btn-circle btn-success btn-action-view">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @can('edit', $data['moduleCode'])
                                                <a href="{{ route('inventory.application.edit', $inventory->id) }}" 
                                                   data-toggle="tooltip" data-original-title="Edit" 
                                                   class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $data['moduleCode'])
                                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $inventory->id }}" 
                                                   data-original-title="Delete" 
                                                   class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak ada data ditemukan</td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="dataTables_info">
                                Menampilkan {{ $data['inventories']->firstItem() ?? 0 }} sampai {{ $data['inventories']->lastItem() ?? 0 }} 
                                dari {{ $data['inventories']->total() }} data
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {{ $data['inventories']->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Delete functionality
            $('body').on('click', '.btn-action-delete', function() {
                var id = $(this).data("id");
                swal({
                        title: "Apa Anda Yakin?",
                        text: "Data yang sudah di hapus, tidak bisa di kembalikan lagi!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus data ini!",
                        closeOnConfirm: false
                    },
                    function(result) {
                        if (result) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route('inventory.application.destroy') }}",
                                dataType: 'JSON',
                                data: {
                                    'id': id,
                                },
                                success: function(data) {
                                    swal("Berhasil!", "Data berhasil dihapus.",
                                        "success");
                                    location.reload();
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection
