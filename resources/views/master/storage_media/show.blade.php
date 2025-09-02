@extends('page')

@section('title', 'Detail Storage Media')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.storage_media.index') }}">Master Storage Media</a></li>
        <li class="active">Detail Storage Media</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail Storage Media <small>Informasi Lengkap Metadata Perangkat Keras Media Penyimpanan</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Detail Storage Media</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.storage_media.edit', $storageMedia->id) }}" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('master.storage_media.index') }}" class="btn btn-xs btn-default">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>ID</strong></td>
                                <td>: {{ $storageMedia->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Data Storage</strong></td>
                                <td>: {{ $storageMedia->nama_data_storage }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>: {{ $storageMedia->deskripsi_data_storage ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Data yang Digunakan</strong></td>
                                <td>: {{ $storageMedia->dataYangDigunakan->nama_data ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status Kepemilikan</strong></td>
                                <td>: 
                                    @switch($storageMedia->status_kepemilikan)
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
                            </tr>
                            <tr>
                                <td><strong>Nama Pemilik</strong></td>
                                <td>: {{ $storageMedia->nama_pemilik ?: '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Unit Pengelola</strong></td>
                                <td>: {{ $storageMedia->unitPengelola->nama_unit ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi Data Storage</strong></td>
                                <td>: {{ $storageMedia->lokasiDataStorage->nama_metadata ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Perangkat Lunak</strong></td>
                                <td>: {{ $storageMedia->perangkatLunak->nama_perangkat_lunak ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kapasitas Penyimpanan</strong></td>
                                <td>: {{ number_format($storageMedia->kapasitas_penyimpanan) }} GB</td>
                            </tr>
                            <tr>
                                <td><strong>Metode Akses</strong></td>
                                <td>: 
                                    @if($storageMedia->metode_akses_data_sharing == 'das')
                                        <span class="label label-info">Direct Attached Storage (DAS)</span>
                                    @else
                                        <span class="label label-success">Network Attached Storage (NAS)</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Metadata Terkait</strong></td>
                                <td>: {{ $storageMedia->metadataSpbe->nama_metadata ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                    @if($storageMedia->status == 'active')
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('master.storage_media.edit', $storageMedia->id) }}" class="btn btn-warning">
                                <i class="fa fa-edit"></i> Edit Data
                            </a>
                            <a href="{{ route('master.storage_media.index') }}" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Kembali ke List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
