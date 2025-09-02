@extends('page')

@section('title', 'Edit Unit')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.unit.index') }}">Master Unit</a></li>
        <li class="active">Edit Unit</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Unit <small>Form Edit Unit</small></h1>
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
                <h4 class="panel-title">Form Edit Unit</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.unit.index') }}" class="btn btn-xs btn-default">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="panel-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('master.unit.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode_unit">Kode Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_unit') is-invalid @enderror" 
                               id="kode_unit" name="kode_unit" value="{{ old('kode_unit', $unit->kode_unit) }}" required>
                        @error('kode_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_unit">Nama Unit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_unit') is-invalid @enderror" 
                               id="nama_unit" name="nama_unit" value="{{ old('nama_unit', $unit->nama_unit) }}" required>
                        @error('nama_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_unit">Tipe Unit <span class="text-danger">*</span></label>
                        <select class="form-control @error('tipe_unit') is-invalid @enderror" id="tipe_unit" name="tipe_unit" required>
                            <option value="">Pilih Tipe Unit</option>
                            <option value="pengembang" {{ old('tipe_unit', $unit->tipe_unit) == 'pengembang' ? 'selected' : '' }}>Pengembang</option>
                            <option value="operasional" {{ old('tipe_unit', $unit->tipe_unit) == 'operasional' ? 'selected' : '' }}>Operasional</option>
                            <option value="keduanya" {{ old('tipe_unit', $unit->tipe_unit) == 'keduanya' ? 'selected' : '' }}>Keduanya</option>
                        </select>
                        @error('tipe_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $unit->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status', $unit->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $unit->status) == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update
                        </button>
                        <a href="{{ route('master.unit.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
