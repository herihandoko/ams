@extends('page')

@section('title', 'Edit Layanan')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.layanan.index') }}">Master Layanan</a></li>
        <li class="active">Edit Layanan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Layanan <small>Form Edit Layanan</small></h1>
    <!-- end page-header -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Layanan</h3>
                    <div class="card-tools">
                        <a href="{{ route('master.layanan.index') }}" class="btn btn-secondary btn-sm">
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

                    <form action="{{ route('master.layanan.update', $layanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kode_layanan">Kode Layanan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_layanan') is-invalid @enderror" 
                                   id="kode_layanan" name="kode_layanan" value="{{ old('kode_layanan', $layanan->kode_layanan) }}" required>
                            @error('kode_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" 
                                   id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                            @error('nama_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a href="{{ route('master.layanan.index') }}" class="btn btn-secondary">
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
