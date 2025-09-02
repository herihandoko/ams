@extends('page')

@section('title', 'Edit Storage Media')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.storage_media.index') }}">Master Storage Media</a></li>
        <li class="active">Edit Storage Media</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Storage Media <small>Form Edit Metadata Perangkat Keras Media Penyimpanan</small></h1>
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
                <h4 class="panel-title">Form Edit Storage Media</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.storage_media.index') }}" class="btn btn-xs btn-default">
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

                <form action="{{ route('master.storage_media.update', $storageMedia->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_data_storage">Nama Data Storage <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_data_storage') is-invalid @enderror" 
                               id="nama_data_storage" name="nama_data_storage" value="{{ old('nama_data_storage', $storageMedia->nama_data_storage) }}" required>
                        @error('nama_data_storage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nama dari data storage yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_data_storage">Deskripsi Data Storage</label>
                        <textarea class="form-control @error('deskripsi_data_storage') is-invalid @enderror" 
                                  id="deskripsi_data_storage" name="deskripsi_data_storage" rows="3">{{ old('deskripsi_data_storage', $storageMedia->deskripsi_data_storage) }}</textarea>
                        @error('deskripsi_data_storage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Berisi deskripsi dari data storage yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="data_yang_digunakan_id">Data yang Digunakan</label>
                        <select class="form-control @error('data_yang_digunakan_id') is-invalid @enderror" id="data_yang_digunakan_id" name="data_yang_digunakan_id">
                            <option value="">Pilih Data Metadata</option>
                            @foreach($data['data_metadata'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('data_yang_digunakan_id', $storageMedia->data_yang_digunakan_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('data_yang_digunakan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Data yang disimpan pada media penyimpanan data</small>
                    </div>

                    <div class="form-group">
                        <label for="status_kepemilikan">Status Kepemilikan <span class="text-danger">*</span></label>
                        <select class="form-control @error('status_kepemilikan') is-invalid @enderror" id="status_kepemilikan" name="status_kepemilikan" required>
                            <option value="">Pilih Status Kepemilikan</option>
                            <option value="milik_sendiri" {{ old('status_kepemilikan', $storageMedia->status_kepemilikan) == 'milik_sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                            <option value="milik_instansi_pemerintah_lain" {{ old('status_kepemilikan', $storageMedia->status_kepemilikan) == 'milik_instansi_pemerintah_lain' ? 'selected' : '' }}>Milik Instansi Pemerintah Lain</option>
                            <option value="milik_bumn" {{ old('status_kepemilikan', $storageMedia->status_kepemilikan) == 'milik_bumn' ? 'selected' : '' }}>Milik BUMN</option>
                            <option value="milik_pihak_ketiga" {{ old('status_kepemilikan', $storageMedia->status_kepemilikan) == 'milik_pihak_ketiga' ? 'selected' : '' }}>Milik Pihak Ketiga</option>
                        </select>
                        @error('status_kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Status kepemilikan dari data storage yang digunakan</small>
                    </div>

                    <div class="form-group" id="nama_pemilik_group" style="display: none;">
                        <label for="nama_pemilik">Nama Pemilik</label>
                        <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" 
                               id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik', $storageMedia->nama_pemilik) }}" placeholder="Contoh: Microsoft, Oracle, Telkom">
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nama pemilik data storage yang digunakan, diisi jika pilihan pada status kepemilikan selain milik sendiri</small>
                    </div>

                    <div class="form-group">
                        <label for="unit_pengelola_id">Unit Pengelola Data Storage</label>
                        <select class="form-control @error('unit_pengelola_id') is-invalid @enderror" id="unit_pengelola_id" name="unit_pengelola_id">
                            <option value="">Pilih Unit</option>
                            @foreach($data['units'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('unit_pengelola_id', $storageMedia->unit_pengelola_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('unit_pengelola_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Unit pengelola data storage yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="lokasi_data_storage_id">Lokasi Data Storage</label>
                        <select class="form-control @error('lokasi_data_storage_id') is-invalid @enderror" id="lokasi_data_storage_id" name="lokasi_data_storage_id">
                            <option value="">Pilih Lokasi</option>
                            @foreach($data['metadata_spbe'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('lokasi_data_storage_id', $storageMedia->lokasi_data_storage_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('lokasi_data_storage_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Lokasi dari data storage yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="perangkat_lunak_id">Perangkat Lunak yang Digunakan</label>
                        <select class="form-control @error('perangkat_lunak_id') is-invalid @enderror" id="perangkat_lunak_id" name="perangkat_lunak_id">
                            <option value="">Pilih Software Platform</option>
                            @foreach($data['software_platforms'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('perangkat_lunak_id', $storageMedia->perangkat_lunak_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('perangkat_lunak_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Perangkat lunak yang digunakan oleh data storage</small>
                    </div>

                    <div class="form-group">
                        <label for="kapasitas_penyimpanan">Kapasitas Penyimpanan (GB) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('kapasitas_penyimpanan') is-invalid @enderror" 
                               id="kapasitas_penyimpanan" name="kapasitas_penyimpanan" value="{{ old('kapasitas_penyimpanan', $storageMedia->kapasitas_penyimpanan) }}" min="1" required>
                        @error('kapasitas_penyimpanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jumlah kapasitas penyimpanan pada data storage dalam Gigabyte (GB)</small>
                    </div>

                    <div class="form-group">
                        <label for="metode_akses_data_sharing">Metode Akses Data Sharing <span class="text-danger">*</span></label>
                        <select class="form-control @error('metode_akses_data_sharing') is-invalid @enderror" id="metode_akses_data_sharing" name="metode_akses_data_sharing" required>
                            <option value="">Pilih Metode Akses</option>
                            <option value="das" {{ old('metode_akses_data_sharing', $storageMedia->metode_akses_data_sharing) == 'das' ? 'selected' : '' }}>Direct Attached Storage (DAS)</option>
                            <option value="nas" {{ old('metode_akses_data_sharing', $storageMedia->metode_akses_data_sharing) == 'nas' ? 'selected' : '' }}>Network Attached Storage (NAS)</option>
                        </select>
                        @error('metode_akses_data_sharing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Metode akses data sharing yang digunakan pada data storage</small>
                    </div>

                    <div class="form-group">
                        <label for="id_metadata_terkait">ID Metadata Terkait</label>
                        <select class="form-control @error('id_metadata_terkait') is-invalid @enderror" id="id_metadata_terkait" name="id_metadata_terkait">
                            <option value="">Pilih Metadata SPBE</option>
                            @foreach($data['metadata_spbe'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('id_metadata_terkait', $storageMedia->id_metadata_terkait) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('id_metadata_terkait')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Mengacu kepada metadata SPBE terkait</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update
                        </button>
                        <a href="{{ route('master.storage_media.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusKepemilikanSelect = document.getElementById('status_kepemilikan');
    const namaPemilikGroup = document.getElementById('nama_pemilik_group');

    function toggleNamaPemilik() {
        const selectedValue = statusKepemilikanSelect.value;
        
        if (selectedValue === 'milik_sendiri') {
            namaPemilikGroup.style.display = 'none';
        } else {
            namaPemilikGroup.style.display = 'block';
        }
    }

    statusKepemilikanSelect.addEventListener('change', toggleNamaPemilik);
    
    // Initialize on page load
    toggleNamaPemilik();
});
</script>
@endsection
