<div class="form-group">
    <label for="type" class="col-md-3 control-label">Type <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select(
            'type',
            [
                'on_prem' => 'On-prem',
                'cloud' => 'Cloud',
            ],
            isset($server->type) ? $server->type : old('type'),
            ['class' => $errors->has('type') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('type') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="id_hardware" class="col-md-3 control-label">Hardware</label>
    <div class="col-md-9">
        {{ Form::select(
            'id_hardware',
            $data['hardware'],
            isset($servers->id_hardware) ? $servers->id_hardware : old('id_hardware'),
            ['class' => $errors->has('id_hardware') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('id_hardware') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="ip" class="col-md-3 control-label">Server Name <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('ip', isset($servers->ip) ? $servers->ip : old('ip'), ['class' => $errors->has('ip') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '127.0.0.1']) }}
        <span style="color:red !important;">{{ $errors->first('ip') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('hdd', 'Hardisc', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('hdd', isset($servers->hdd) ? $servers->hdd : old('hdd'), ['class' => $errors->has('hdd') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '512GB']) }}
        <span style="color:red !important;">{{ $errors->first('hdd') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('ram', 'RAM', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('ram', isset($servers->ram) ? $servers->ram : old('ram'), ['class' => $errors->has('ram') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '8x32GB']) }}
        <span style="color:red !important;">{{ $errors->first('ram') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('cpu', 'CPU', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('cpu', isset($servers->cpu) ? $servers->cpu : old('cpu'), ['class' => $errors->has('cpu') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Core i7 Intel, Quard Core']) }}
        <span style="color:red !important;">{{ $errors->first('cpu') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="status" class="col-md-3 control-label">Status <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select(
            'status',
            [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
            isset($server->status) ? $server->status : old('status'),
            ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('status') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('nama_server', 'Nama Server', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('nama_server', isset($servers->nama_server) ? $servers->nama_server : old('nama_server'), ['class' => $errors->has('nama_server') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: Server Web Production']) }}
        <span style="color:red !important;">{{ $errors->first('nama_server') }}</span>
        <small class="text-muted">Nama dari perangkat server yang digunakan</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('deskripsi_server', 'Deskripsi Server', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::textarea('deskripsi_server', isset($servers->deskripsi_server) ? $servers->deskripsi_server : old('deskripsi_server'), ['class' => $errors->has('deskripsi_server') ? 'form-control is-invalid' : 'form-control', 'rows' => 3, 'placeholder' => 'Berisi deskripsi dari perangkat server yang digunakan']) }}
        <span style="color:red !important;">{{ $errors->first('deskripsi_server') }}</span>
        <small class="text-muted">Berisi deskripsi dari perangkat server yang digunakan</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('jenis_penggunaan_server', 'Jenis Penggunaan Server', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'jenis_penggunaan_server',
            [
                'web_server' => 'Web Server',
                'mail_server' => 'Mail Server',
                'aplikasi' => 'Aplikasi',
                'database' => 'Database',
                'file_server' => 'File Server',
                'active_directory' => 'Active Directory',
                'keamanan_informasi' => 'Keamanan Informasi',
            ],
            isset($servers->jenis_penggunaan_server) ? $servers->jenis_penggunaan_server : old('jenis_penggunaan_server'),
            ['class' => $errors->has('jenis_penggunaan_server') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('jenis_penggunaan_server') }}</span>
        <small class="text-muted">Jenis penggunaan dari server yang digunakan</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('status_kepemilikan', 'Status Kepemilikan', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'status_kepemilikan',
            [
                'milik_sendiri' => 'Milik Sendiri',
                'milik_instansi_pemerintah_lain' => 'Milik Instansi Pemerintah Lain',
                'milik_bumn' => 'Milik BUMN',
                'milik_pihak_ketiga' => 'Milik Pihak Ketiga',
            ],
            isset($servers->status_kepemilikan) ? $servers->status_kepemilikan : old('status_kepemilikan'),
            ['class' => $errors->has('status_kepemilikan') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('status_kepemilikan') }}</span>
        <small class="text-muted">Status kepemilikan dari server yang digunakan</small>
    </div>
</div>

<div class="form-group" id="nama_pemilik_group" style="display: none;">
    {{ Form::label('nama_pemilik', 'Nama Pemilik', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('nama_pemilik', isset($servers->nama_pemilik) ? $servers->nama_pemilik : old('nama_pemilik'), ['class' => $errors->has('nama_pemilik') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: Microsoft, Oracle, Telkom']) }}
        <span style="color:red !important;">{{ $errors->first('nama_pemilik') }}</span>
        <small class="text-muted">Nama pemilik server yang digunakan, diisi jika pilihan pada status kepemilikan selain milik sendiri</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('unit_pengelola_id', 'Unit Pengelola Server', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'unit_pengelola_id',
            $data['units'],
            isset($servers->unit_pengelola_id) ? $servers->unit_pengelola_id : old('unit_pengelola_id'),
            ['class' => $errors->has('unit_pengelola_id') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('unit_pengelola_id') }}</span>
        <small class="text-muted">Unit pengelola server yang digunakan</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('lokasi_fasilitas_id', 'Lokasi Perangkat Keras Server', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'lokasi_fasilitas_id',
            $data['metadata_spbe'],
            isset($servers->lokasi_fasilitas_id) ? $servers->lokasi_fasilitas_id : old('lokasi_fasilitas_id'),
            ['class' => $errors->has('lokasi_fasilitas_id') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('lokasi_fasilitas_id') }}</span>
        <small class="text-muted">Lokasi dari perangkat server yang digunakan</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('perangkat_lunak_id', 'Perangkat Lunak yang Digunakan', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'perangkat_lunak_id',
            $data['software_platforms'],
            isset($servers->perangkat_lunak_id) ? $servers->perangkat_lunak_id : old('perangkat_lunak_id'),
            ['class' => $errors->has('perangkat_lunak_id') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('perangkat_lunak_id') }}</span>
        <small class="text-muted">Perangkat lunak yang digunakan oleh server</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('jenis_teknologi_prosesor', 'Jenis Teknologi Prosesor', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'jenis_teknologi_prosesor',
            [
                'high_end' => 'High End',
                'mid_end' => 'Mid End',
                'low_end' => 'Low End',
            ],
            isset($servers->jenis_teknologi_prosesor) ? $servers->jenis_teknologi_prosesor : old('jenis_teknologi_prosesor'),
            ['class' => $errors->has('jenis_teknologi_prosesor') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('jenis_teknologi_prosesor') }}</span>
        <small class="text-muted">Jenis teknologi prosesor yang digunakan oleh server</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('teknik_penyimpanan', 'Teknik Penyimpanan', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'teknik_penyimpanan',
            [
                'raid_1' => 'RAID 1',
                'raid_3' => 'RAID 3',
                'raid_5' => 'RAID 5',
                'non_raid' => 'Non-RAID',
            ],
            isset($servers->teknik_penyimpanan) ? $servers->teknik_penyimpanan : old('teknik_penyimpanan'),
            ['class' => $errors->has('teknik_penyimpanan') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('teknik_penyimpanan') }}</span>
        <small class="text-muted">Teknik penyimpanan yang digunakan pada server</small>
    </div>
</div>

<div class="form-group">
    {{ Form::label('id_metadata_terkait', 'ID Metadata Terkait', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::select(
            'id_metadata_terkait',
            $data['metadata_spbe'],
            isset($servers->id_metadata_terkait) ? $servers->id_metadata_terkait : old('id_metadata_terkait'),
            ['class' => $errors->has('id_metadata_terkait') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('id_metadata_terkait') }}</span>
        <small class="text-muted">Mengacu kepada metadata SPBE terkait</small>
    </div>
</div>

<div class="form-group has-error has-feedback">
    <div class="col-md-8 col-md-offset-3">
        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
        <a href="{{ route('master.servers.index') }}" class="btn btn-sm btn-default">Cancel</a>
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
