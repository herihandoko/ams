@extends('page')

@section('title', 'Edit Metadata SPBE')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.metadata_spbe.index') }}">Master Metadata SPBE</a></li>
        <li class="active">Edit Metadata SPBE</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Metadata SPBE <small>Form Edit Metadata SPBE</small></h1>
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
                <h4 class="panel-title">Form Edit Metadata SPBE</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.metadata_spbe.index') }}" class="btn btn-xs btn-default">
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

                <form action="{{ route('master.metadata_spbe.update', $metadataSpbe->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode_metadata">Kode Metadata <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_metadata') is-invalid @enderror" 
                               id="kode_metadata" name="kode_metadata" value="{{ old('kode_metadata', $metadataSpbe->kode_metadata) }}" required>
                        @error('kode_metadata')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_metadata">Nama Metadata <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_metadata') is-invalid @enderror" 
                               id="nama_metadata" name="nama_metadata" value="{{ old('nama_metadata', $metadataSpbe->nama_metadata) }}" required>
                        @error('nama_metadata')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                               id="kategori" name="kategori" value="{{ old('kategori', $metadataSpbe->kategori) }}" placeholder="Contoh: Aplikasi, Layanan, Data">
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $metadataSpbe->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status', $metadataSpbe->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $metadataSpbe->status) == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update
                        </button>
                        <a href="{{ route('master.metadata_spbe.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
