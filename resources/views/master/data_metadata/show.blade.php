@extends('page')

@section('title', 'Detail Data Metadata')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.data_metadata.index') }}">Master Data Metadata</a></li>
        <li class="active">Detail Data Metadata</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail Data Metadata <small>Informasi Lengkap Data Metadata</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Data Metadata</h3>
                    <div class="card-tools">
                        <a href="{{ route('master.data_metadata.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('master.data_metadata.edit', $dataMetadata->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Kode Data</strong></td>
                                    <td>: {{ $dataMetadata->kode_data }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Data</strong></td>
                                    <td>: {{ $dataMetadata->nama_data }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipe Data</strong></td>
                                    <td>: {{ $dataMetadata->tipe_data ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: 
                                        <span class="badge badge-{{ $dataMetadata->status == 'aktif' ? 'success' : 'danger' }}">
                                            {{ ucfirst($dataMetadata->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat Pada</strong></td>
                                    <td>: {{ $dataMetadata->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Update</strong></td>
                                    <td>: {{ $dataMetadata->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Deskripsi:</strong></label>
                                <div class="border p-3 bg-light">
                                    {{ $dataMetadata->deskripsi ?: 'Tidak ada deskripsi' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
