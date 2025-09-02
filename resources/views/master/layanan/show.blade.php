@extends('page')

@section('title', 'Detail Layanan')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.layanan.index') }}">Master Layanan</a></li>
        <li class="active">Detail Layanan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail Layanan <small>Informasi Lengkap Layanan</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Layanan</h3>
                    <div class="card-tools">
                        <a href="{{ route('master.layanan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('master.layanan.edit', $layanan->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Kode Layanan</strong></td>
                                    <td>: {{ $layanan->kode_layanan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Layanan</strong></td>
                                    <td>: {{ $layanan->nama_layanan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: 
                                        <span class="badge badge-{{ $layanan->status == 'aktif' ? 'success' : 'danger' }}">
                                            {{ ucfirst($layanan->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat Pada</strong></td>
                                    <td>: {{ $layanan->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Terakhir Update</strong></td>
                                    <td>: {{ $layanan->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Deskripsi:</strong></label>
                                <div class="border p-3 bg-light">
                                    {{ $layanan->deskripsi ?: 'Tidak ada deskripsi' }}
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
