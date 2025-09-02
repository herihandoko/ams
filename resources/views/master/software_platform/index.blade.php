@extends('page')

@section('title', 'Master Software Platform')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Master Software Platform</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Software Platform <small>Manajemen Metadata Perangkat Lunak Platform</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="{{ route('master.software_platform.create') }}" class="btn btn-xs btn-icon btn-circle btn-primary"><i class="fa fa-plus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Master Software Platform</h4>
            </div>
            <div class="panel-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perangkat Lunak</th>
                                <th>Tipe</th>
                                <th>Jenis Lisensi</th>
                                <th>Metadata Terkait</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($softwarePlatforms as $index => $platform)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $platform->nama_perangkat_lunak }}</td>
                                    <td>
                                        @switch($platform->tipe_perangkat_lunak)
                                            @case('sistem_operasi')
                                                <span class="label label-primary">Sistem Operasi</span>
                                                @break
                                            @case('sistem_utilitas')
                                                <span class="label label-success">Sistem Utilitas</span>
                                                @break
                                            @case('sistem_database')
                                                <span class="label label-info">Sistem Database</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($platform->jenis_lisensi)
                                            @case('lisensi_seumur_hidup')
                                                <span class="label label-success">Lisensi Seumur Hidup</span>
                                                @break
                                            @case('lisensi_periodik')
                                                <span class="label label-warning">Lisensi Periodik</span>
                                                @break
                                            @case('kode_sumber_terbuka')
                                                <span class="label label-info">Kode Sumber Terbuka</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $platform->metadataSpbe->nama_metadata ?? '-' }}</td>
                                    <td>
                                        @if($platform->status == 'active')
                                            <span class="label label-success">Aktif</span>
                                        @else
                                            <span class="label label-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('master.software_platform.show', $platform->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('master.software_platform.edit', $platform->id) }}" class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('master.software_platform.destroy', $platform->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data Software Platform</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $softwarePlatforms->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
