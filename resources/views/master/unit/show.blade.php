@extends('page')

@section('title', 'Detail Unit')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.unit.index') }}">Master Unit</a></li>
        <li class="active">Detail Unit</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail Unit <small>Informasi Lengkap Unit</small></h1>
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
                <h4 class="panel-title">Detail Unit</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.unit.edit', $unit->id) }}" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('master.unit.index') }}" class="btn btn-xs btn-default">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Kode Unit</th>
                                <td>{{ $unit->kode_unit }}</td>
                            </tr>
                            <tr>
                                <th>Nama Unit</th>
                                <td>{{ $unit->nama_unit }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Unit</th>
                                <td>
                                    @if($unit->tipe_unit == 'pengembang')
                                        <span class="label label-primary">Pengembang</span>
                                    @elseif($unit->tipe_unit == 'operasional')
                                        <span class="label label-success">Operasional</span>
                                    @elseif($unit->tipe_unit == 'keduanya')
                                        <span class="label label-info">Keduanya</span>
                                    @else
                                        <span class="label label-default">{{ $unit->tipe_unit }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($unit->status == 'aktif')
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-danger">Non Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ $unit->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Update</th>
                                <td>{{ $unit->updated_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Deskripsi:</strong></label>
                            <div class="well">
                                {{ $unit->deskripsi ?: 'Tidak ada deskripsi' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
