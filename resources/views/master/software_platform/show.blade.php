@extends('page')

@section('title', 'Detail Software Platform')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.software_platform.index') }}">Master Software Platform</a></li>
        <li class="active">Detail Software Platform</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail Software Platform <small>Informasi Lengkap Metadata Perangkat Lunak Platform</small></h1>
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
                <h4 class="panel-title">Detail Software Platform</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.software_platform.edit', $softwarePlatform->id) }}" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('master.software_platform.index') }}" class="btn btn-xs btn-default">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Nama Perangkat Lunak</strong></td>
                                <td width="20">:</td>
                                <td>{{ $softwarePlatform->nama_perangkat_lunak }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->deskripsi_perangkat_lunak ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tipe Perangkat Lunak</strong></td>
                                <td>:</td>
                                <td>
                                    @switch($softwarePlatform->tipe_perangkat_lunak)
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
                            </tr>
                            @if($softwarePlatform->tipe_perangkat_lunak == 'sistem_operasi' && $softwarePlatform->jenis_sistem_operasi)
                                <tr>
                                    <td><strong>Jenis Sistem Operasi</strong></td>
                                    <td>:</td>
                                    <td>
                                        @switch($softwarePlatform->jenis_sistem_operasi)
                                            @case('dos')
                                                <span class="label label-default">DOS</span>
                                                @break
                                            @case('unix')
                                                <span class="label label-info">Unix</span>
                                                @break
                                            @case('macos')
                                                <span class="label label-primary">MacOS</span>
                                                @break
                                            @case('windows')
                                                <span class="label label-success">Windows</span>
                                                @break
                                            @case('networking_os')
                                                <span class="label label-warning">Networking OS</span>
                                                @break
                                            @case('lainnya')
                                                <span class="label label-default">Lainnya</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endif
                            @if($softwarePlatform->tipe_perangkat_lunak == 'sistem_utilitas' && $softwarePlatform->jenis_sistem_utilitas)
                                <tr>
                                    <td><strong>Jenis Sistem Utilitas</strong></td>
                                    <td>:</td>
                                    <td>{{ $softwarePlatform->jenis_sistem_utilitas }}</td>
                                </tr>
                            @endif
                            @if($softwarePlatform->tipe_perangkat_lunak == 'sistem_database' && $softwarePlatform->jenis_sistem_database)
                                <tr>
                                    <td><strong>Jenis Sistem Database</strong></td>
                                    <td>:</td>
                                    <td>{{ $softwarePlatform->jenis_sistem_database }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Jenis Lisensi</strong></td>
                                <td width="20">:</td>
                                <td>
                                    @switch($softwarePlatform->jenis_lisensi)
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
                            </tr>
                            <tr>
                                <td><strong>Nama Pemilik Lisensi</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->nama_pemilik_lisensi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Validitas Lisensi</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->validitas_lisensi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Metadata SPBE Terkait</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->metadataSpbe->nama_metadata ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:</td>
                                <td>
                                    @if($softwarePlatform->status == 'active')
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat Pada</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>:</td>
                                <td>{{ $softwarePlatform->updated_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('master.software_platform.edit', $softwarePlatform->id) }}" class="btn btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('master.software_platform.index') }}" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
