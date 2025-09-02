@extends('page')

@section('title', 'Edit Data Metadata')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.data_metadata.index') }}">Master Data Metadata</a></li>
        <li class="active">Edit Data Metadata</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Data Metadata <small>Form Edit Data Metadata</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Metadata</h3>
                    <div class="card-tools">
                        <a href="{{ route('master.data_metadata.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('master.data_metadata.update', $dataMetadata->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode_data">Kode Data <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_data') is-invalid @enderror" 
                                   id="kode_data" name="kode_data" value="{{ old('kode_data', $dataMetadata->kode_data) }}" required>
                            @error('kode_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_data">Nama Data <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_data') is-invalid @enderror" 
                                   id="nama_data" name="nama_data" value="{{ old('nama_data', $dataMetadata->nama_data) }}" required>
                            @error('nama_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tipe_data">Tipe Data</label>
                            <input type="text" class="form-control @error('tipe_data') is-invalid @enderror" 
                                   id="tipe_data" name="tipe_data" value="{{ old('tipe_data', $dataMetadata->tipe_data) }}" placeholder="Contoh: Master, Transaksional, Referensi">
                            @error('tipe_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $dataMetadata->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status', $dataMetadata->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $dataMetadata->status) == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('master.data_metadata.index') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
