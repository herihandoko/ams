@extends('page')

@section('title', 'Master Layanan')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Master Layanan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Layanan <small>Manajemen Data Layanan</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="{{ route('master.layanan.create') }}" class="btn btn-xs btn-icon btn-success btn-circle">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Master Layanan</h4>
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
                                    <th>Kode Layanan</th>
                                    <th>Nama Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($layanans as $index => $layanan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $layanan->kode_layanan }}</td>
                                        <td>{{ $layanan->nama_layanan }}</td>
                                        <td>{{ Str::limit($layanan->deskripsi, 100) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $layanan->status == 'aktif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($layanan->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('master.layanan.show', $layanan->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('master.layanan.edit', $layanan->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('master.layanan.destroy', $layanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data layanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $layanans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
