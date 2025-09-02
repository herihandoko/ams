@extends('page')

@section('title', 'Edit Software Platform')

@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.software_platform.index') }}">Master Software Platform</a></li>
        <li class="active">Edit Software Platform</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit Software Platform <small>Form Edit Metadata Perangkat Lunak Platform</small></h1>
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
                <h4 class="panel-title">Form Edit Software Platform</h4>
                <div class="panel-heading-btn">
                    <a href="{{ route('master.software_platform.index') }}" class="btn btn-xs btn-default">
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

                <form action="{{ route('master.software_platform.update', $softwarePlatform->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_perangkat_lunak">Nama Perangkat Lunak <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_perangkat_lunak') is-invalid @enderror" 
                               id="nama_perangkat_lunak" name="nama_perangkat_lunak" value="{{ old('nama_perangkat_lunak', $softwarePlatform->nama_perangkat_lunak) }}" required>
                        @error('nama_perangkat_lunak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nama Perangkat Lunak yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_perangkat_lunak">Deskripsi Perangkat Lunak</label>
                        <textarea class="form-control @error('deskripsi_perangkat_lunak') is-invalid @enderror" 
                                  id="deskripsi_perangkat_lunak" name="deskripsi_perangkat_lunak" rows="3">{{ old('deskripsi_perangkat_lunak', $softwarePlatform->deskripsi_perangkat_lunak) }}</textarea>
                        @error('deskripsi_perangkat_lunak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Penjelasan dari Perangkat Lunak yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="tipe_perangkat_lunak">Tipe Perangkat Lunak <span class="text-danger">*</span></label>
                        <select class="form-control @error('tipe_perangkat_lunak') is-invalid @enderror" id="tipe_perangkat_lunak" name="tipe_perangkat_lunak" required>
                            <option value="">Pilih Tipe Perangkat Lunak</option>
                            <option value="sistem_operasi" {{ old('tipe_perangkat_lunak', $softwarePlatform->tipe_perangkat_lunak) == 'sistem_operasi' ? 'selected' : '' }}>Sistem Operasi</option>
                            <option value="sistem_utilitas" {{ old('tipe_perangkat_lunak', $softwarePlatform->tipe_perangkat_lunak) == 'sistem_utilitas' ? 'selected' : '' }}>Sistem Utilitas</option>
                            <option value="sistem_database" {{ old('tipe_perangkat_lunak', $softwarePlatform->tipe_perangkat_lunak) == 'sistem_database' ? 'selected' : '' }}>Sistem Database</option>
                        </select>
                        @error('tipe_perangkat_lunak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jenis dari Perangkat Lunak yang digunakan</small>
                    </div>

                    <!-- Conditional field for Sistem Operasi -->
                    <div class="form-group" id="jenis_sistem_operasi_group" style="display: none;">
                        <label for="jenis_sistem_operasi">Jenis Sistem Operasi</label>
                        <select class="form-control @error('jenis_sistem_operasi') is-invalid @enderror" id="jenis_sistem_operasi" name="jenis_sistem_operasi">
                            <option value="">Pilih Jenis Sistem Operasi</option>
                            <option value="dos" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'dos' ? 'selected' : '' }}>DOS</option>
                            <option value="unix" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'unix' ? 'selected' : '' }}>Unix</option>
                            <option value="macos" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'macos' ? 'selected' : '' }}>MacOS</option>
                            <option value="windows" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'windows' ? 'selected' : '' }}>Windows</option>
                            <option value="networking_os" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'networking_os' ? 'selected' : '' }}>Networking OS</option>
                            <option value="lainnya" {{ old('jenis_sistem_operasi', $softwarePlatform->jenis_sistem_operasi) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_sistem_operasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jenis Sistem Operasi yang digunakan</small>
                    </div>

                    <!-- Conditional field for Sistem Utilitas -->
                    <div class="form-group" id="jenis_sistem_utilitas_group" style="display: none;">
                        <label for="jenis_sistem_utilitas">Jenis Sistem Utilitas</label>
                        <input type="text" class="form-control @error('jenis_sistem_utilitas') is-invalid @enderror" 
                               id="jenis_sistem_utilitas" name="jenis_sistem_utilitas" value="{{ old('jenis_sistem_utilitas', $softwarePlatform->jenis_sistem_utilitas) }}" placeholder="Contoh: Antivirus, Backup, Monitoring">
                        @error('jenis_sistem_utilitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jenis Sistem Utilitas yang digunakan</small>
                    </div>

                    <!-- Conditional field for Sistem Database -->
                    <div class="form-group" id="jenis_sistem_database_group" style="display: none;">
                        <label for="jenis_sistem_database">Jenis Sistem Database</label>
                        <input type="text" class="form-control @error('jenis_sistem_database') is-invalid @enderror" 
                               id="jenis_sistem_database" name="jenis_sistem_database" value="{{ old('jenis_sistem_database', $softwarePlatform->jenis_sistem_database) }}" placeholder="Contoh: MySQL, PostgreSQL, Oracle">
                        @error('jenis_sistem_database')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jenis Sistem Database yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="jenis_lisensi">Jenis Lisensi <span class="text-danger">*</span></label>
                        <select class="form-control @error('jenis_lisensi') is-invalid @enderror" id="jenis_lisensi" name="jenis_lisensi" required>
                            <option value="">Pilih Jenis Lisensi</option>
                            <option value="lisensi_seumur_hidup" {{ old('jenis_lisensi', $softwarePlatform->jenis_lisensi) == 'lisensi_seumur_hidup' ? 'selected' : '' }}>Lisensi Seumur Hidup</option>
                            <option value="lisensi_periodik" {{ old('jenis_lisensi', $softwarePlatform->jenis_lisensi) == 'lisensi_periodik' ? 'selected' : '' }}>Lisensi Periodik</option>
                            <option value="kode_sumber_terbuka" {{ old('jenis_lisensi', $softwarePlatform->jenis_lisensi) == 'kode_sumber_terbuka' ? 'selected' : '' }}>Kode Sumber Terbuka</option>
                        </select>
                        @error('jenis_lisensi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Jenis Lisensi Perangkat Lunak yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="nama_pemilik_lisensi">Nama Pemilik Lisensi</label>
                        <input type="text" class="form-control @error('nama_pemilik_lisensi') is-invalid @enderror" 
                               id="nama_pemilik_lisensi" name="nama_pemilik_lisensi" value="{{ old('nama_pemilik_lisensi', $softwarePlatform->nama_pemilik_lisensi) }}" placeholder="Contoh: Microsoft, Oracle, Open Source Community">
                        @error('nama_pemilik_lisensi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nama pemilik dari lisensi perangkat lunak</small>
                    </div>

                    <div class="form-group">
                        <label for="validitas_lisensi">Validitas Lisensi</label>
                        <textarea class="form-control @error('validitas_lisensi') is-invalid @enderror" 
                                  id="validitas_lisensi" name="validitas_lisensi" rows="3">{{ old('validitas_lisensi', $softwarePlatform->validitas_lisensi) }}</textarea>
                        @error('validitas_lisensi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Penjelasan validitas dari lisensi perangkat lunak yang digunakan</small>
                    </div>

                    <div class="form-group">
                        <label for="id_metadata_terkait">Metadata SPBE Terkait</label>
                        <select class="form-control @error('id_metadata_terkait') is-invalid @enderror" id="id_metadata_terkait" name="id_metadata_terkait">
                            <option value="">Pilih Metadata SPBE</option>
                            @foreach($data['metadata_spbe'] as $id => $nama)
                                <option value="{{ $id }}" {{ old('id_metadata_terkait', $softwarePlatform->id_metadata_terkait) == $id ? 'selected' : '' }}>{{ $nama }}</option>
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
                        <a href="{{ route('master.software_platform.index') }}" class="btn btn-secondary">
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
    const tipeSelect = document.getElementById('tipe_perangkat_lunak');
    const osGroup = document.getElementById('jenis_sistem_operasi_group');
    const utilitasGroup = document.getElementById('jenis_sistem_utilitas_group');
    const databaseGroup = document.getElementById('jenis_sistem_database_group');

    function toggleConditionalFields() {
        const selectedValue = tipeSelect.value;
        
        // Hide all conditional fields first
        osGroup.style.display = 'none';
        utilitasGroup.style.display = 'none';
        databaseGroup.style.display = 'none';
        
        // Show relevant field based on selection
        if (selectedValue === 'sistem_operasi') {
            osGroup.style.display = 'block';
        } else if (selectedValue === 'sistem_utilitas') {
            utilitasGroup.style.display = 'block';
        } else if (selectedValue === 'sistem_database') {
            databaseGroup.style.display = 'block';
        }
    }

    tipeSelect.addEventListener('change', toggleConditionalFields);
    
    // Initialize on page load
    toggleConditionalFields();
});
</script>
@endsection
