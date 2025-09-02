@extends('page')

@section('title', 'Master Unit')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Master Unit</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Unit <small>Manajemen Data Unit</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="{{ route('master.unit.create') }}" class="btn btn-xs btn-icon btn-success btn-circle">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Master Unit</h4>
            </div>
            <div class="panel-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Unit</th>
                                    <th>Nama Unit</th>
                                    <th>Tipe Unit</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $index => $unit)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $unit->kode_unit }}</td>
                                        <td>{{ $unit->nama_unit }}</td>
                                        <td>
                                            <span class="badge badge-{{ $unit->tipe_unit == 'pengembang' ? 'primary' : ($unit->tipe_unit == 'operasional' ? 'success' : 'info') }}">
                                                {{ ucfirst($unit->tipe_unit) }}
                                            </span>
                                        </td>
                                        <td>{{ Str::limit($unit->deskripsi, 100) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $unit->status == 'aktif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($unit->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('master.unit.show', $unit->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('master.unit.edit', $unit->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('master.unit.destroy', $unit->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus unit ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data unit</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $units->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
