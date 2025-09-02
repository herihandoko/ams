@extends('page')

@section('title', 'Master Storage Media')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Master Storage Media</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Master Storage Media <small>Manajemen Metadata Perangkat Keras Media Penyimpanan</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="{{ route('master.storage_media.create') }}" class="btn btn-xs btn-icon btn-circle btn-primary"><i class="fa fa-plus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Master Storage Media</h4>
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
                                <th>Nama Data Storage</th>
                                <th>Data yang Digunakan</th>
                                <th>Status Kepemilikan</th>
                                <th>Unit Pengelola</th>
                                <th>Kapasitas (GB)</th>
                                <th>Metode Akses</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($storageMedia as $index => $media)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $media->nama_data_storage }}</td>
                                    <td>{{ $media->dataYangDigunakan->nama_data ?? '-' }}</td>
                                    <td>
                                        @switch($media->status_kepemilikan)
                                            @case('milik_sendiri')
                                                <span class="label label-success">Milik Sendiri</span>
                                                @break
                                            @case('milik_instansi_pemerintah_lain')
                                                <span class="label label-info">Milik Instansi Pemerintah Lain</span>
                                                @break
                                            @case('milik_bumn')
                                                <span class="label label-warning">Milik BUMN</span>
                                                @break
                                            @case('milik_pihak_ketiga')
                                                <span class="label label-primary">Milik Pihak Ketiga</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{ $media->unitPengelola->nama_unit ?? '-' }}</td>
                                    <td>{{ number_format($media->kapasitas_penyimpanan) }} GB</td>
                                    <td>
                                        @if($media->metode_akses_data_sharing == 'das')
                                            <span class="label label-info">DAS</span>
                                        @else
                                            <span class="label label-success">NAS</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($media->status == 'active')
                                            <span class="label label-success">Aktif</span>
                                        @else
                                            <span class="label label-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('master.storage_media.show', $media->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('master.storage_media.edit', $media->id) }}" class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('master.storage_media.destroy', $media->id) }}" method="POST" style="display: inline;">
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
                                    <td colspan="9" class="text-center">Tidak ada data Storage Media</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $storageMedia->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
