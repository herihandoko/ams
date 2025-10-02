<h4>Detail Aplikasi</h4>
<p>
    Anda dapat memeriksa semua informasi aplikasi Anda di bawah.<br>
    <span class="text-muted">Silakan isi kolom sesuai kebutuhan.</span>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('code', 'Kode Aplikasi', ['class' => 'control-label']) }}
            {{ Form::text('code', isset($application->code) ? $application->code : (old('code') ? old('code') : $data['code']), ['class' => $errors->has('code') ? 'form-control is-invalid' : 'form-control']) }}
            <small class="text-muted">Merupakan nomor unik sebagai identitas metadata</small>
            <span style="color:red !important;">{{ $errors->first('code') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('name', 'Nama Aplikasi', ['class' => 'control-label']) }}            {{ Form::text('name', isset($application->name) ? $application->name : old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
            <small class="text-muted">Nama aplikasi yang digunakan atau dimiliki</small>
            <span style="color:red !important;">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Deskripsi/Uraian', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'description',
                isset($application->keterangan) ? $application->keterangan : old('description'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control', 'rows' => 4],
            ) }}
            <small class="text-muted">Berisi uraian atau deskripsi secara umum dari aplikasi</small>
            <span style="color:red !important;">{{ $errors->first('description') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('version', 'Versi', ['class' => 'control-label']) }}            {{ Form::text('version', isset($application->version) ? $application->version : old('version'), ['class' => $errors->has('version') ? 'form-control is-invalid' : 'form-control']) }}
            <small class="text-muted">Versi aplikasi yang sedang digunakan</small>
            <span style="color:red !important;">{{ $errors->first('version') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('user_base', 'Basis pengguna', ['class' => 'control-label']) }}            {{ Form::select(
                'user_base',
                [
                    '1-10' => '1-10',
                    '10-25' => '10-25',
                    '25-100' => '25-100',
                    '100-250' => '100-250',
                    '250-1000' => '250-1000',
                    '1000+' => '1000+',
                ],
                isset($application->user_base) ? $application->user_base : old('user_base'),
                ['class' => $errors->has('user_base') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <small class="text-muted">Jumlah pengguna yang menggunakan aplikasi</small>
            <span style="color:red !important;">{{ $errors->first('user_base') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('scope', 'Tipe Aplikasi', ['class' => 'control-label']) }}
            <small class="text-muted">Jenis layanan yang disediakan aplikasi</small>
            {{ Form::select(
                'scope',
                $data['layanans'],
                isset($application->scope) ? $application->scope : old('scope'),
                ['class' => $errors->has('scope') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('scope') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('service_api', 'Service API', ['class' => 'control-label']) }}
            <div class="row">
                <div class="col-md-4">
                    {{ Form::select(
                        'service_api',
                        [
                            'ada' => 'Ada',
                            'tidak' => 'Tidak',
                        ],
                        isset($application->service_api) ? $application->service_api : old('service_api'),
                        ['class' => $errors->has('service_api') ? 'form-control is-invalid' : 'form-control'],
                    ) }}
                </div>
                <div class="col-md-8">
                    {{ Form::text('endpoint_api', isset($application->endpoint_api) ? $application->endpoint_api : old('endpoint_api'), ['class' => $errors->has('endpoint_api') ? 'form-control is-invalid' : 'form-control','placeholder'=>'https://bantenprov.go.id/api/v1']) }}
                </div>
            </div>
            <span style="color:red !important;">{{ $errors->first('service_api') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('url', 'Domain/Package/URL/DNS', ['class' => 'control-label']) }}            {{ Form::text('url', isset($application->url) ? $application->url : old('url'), ['class' => $errors->has('url') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('url') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('category', 'Kategori', ['class' => 'control-label']) }}            {{ Form::select(
                'category',
                $data['categories'],
                isset($application->category_id) ? $application->category_id : old('category'),
                ['class' => $errors->has('category') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('category') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('status', 'Status Aplikasi', ['class' => 'control-label']) }}            {{ Form::select(
                'status',
                $data['status_app'],
                isset($application->status) ? $application->status : old('status'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('status') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('platform', 'Platform/Jenis', ['class' => 'control-label']) }}            {{ Form::select(
                'platform',
                [
                    'web' => 'Web',
                    'android' => 'Android',
                    'ios' => 'iOS',
                    'mweb' => 'M-Web',
                    'desktop' => 'Desktop',
                    'aplikasi' => 'Aplikasi',
                    'website' => 'Website'
                ],
                isset($application->platform) ? $application->platform : old('platform'),
                ['class' => $errors->has('platform') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <small class="text-muted">Platform atau jenis aplikasi yang digunakan</small>
            <span style="color:red !important;">{{ $errors->first('platform') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('fungsi', 'Fungsi Aplikasi', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'fungsi',
                isset($application->fungsi) ? $application->fungsi : old('fungsi'),
                ['class' => $errors->has('fungsi') ? 'form-control is-invalid' : 'form-control', 'rows' => 4],
            ) }}
            <small class="text-muted">Berisi keterangan fungsi dari aplikasi terhadap layanan yang didukung</small>
            <span style="color:red !important;">{{ $errors->first('fungsi') }}</span>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <h4>Metadata SPBE</h4>
        <p>
            Informasi metadata SPBE untuk aplikasi ini.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('refferensi_code', 'Kode Model Referensi SPBE', ['class' => 'control-label']) }}
            {{ Form::text('refferensi_code', isset($application->refferensi_code) ? $application->refferensi_code : old('refferensi_code'), ['class' => $errors->has('refferensi_code') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: SPBE-001']) }}
            <small class="text-muted">Kode model referensi yang terkait dengan aplikasi</small>
            <span style="color:red !important;">{{ $errors->first('refferensi_code') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('id_layanan', 'Layanan yang Didukung', ['class' => 'control-label']) }}
            {{ Form::select(
                'id_layanan',
                $data['layanans'] ?? [],
                isset($application->id_layanan) ? $application->id_layanan : old('id_layanan'),
                ['class' => $errors->has('id_layanan') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Layanan'],
            ) }}
            <small class="text-muted">Layanan yang didukung oleh aplikasi, pilihan layanan yang didukung didapat dari metadata layanan</small>
            <span style="color:red !important;">{{ $errors->first('id_layanan') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('id_data', 'Data yang Digunakan', ['class' => 'control-label']) }}
            {{ Form::select(
                'id_data',
                $data['data_metadata'] ?? [],
                isset($application->id_data) ? $application->id_data : old('id_data'),
                ['class' => $errors->has('id_data') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Data'],
            ) }}
            <small class="text-muted">Data yang disimpan pada media penyimpanan data, pilihan data yang digunakan didapat dari metadata data</small>
            <span style="color:red !important;">{{ $errors->first('id_data') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('luaran', 'Luaran/Hasil Aplikasi', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'luaran',
                isset($application->luaran) ? $application->luaran : old('luaran'),
                ['class' => $errors->has('luaran') ? 'form-control is-invalid' : 'form-control', 'rows' => 4, 'placeholder' => 'Jelaskan hasil/luaran dari aplikasi ini'],
            ) }}
            <small class="text-muted">Merupakan hasil-hasil yang diperoleh dari aplikasi yang dimiliki atau digunakan</small>
            <span style="color:red !important;">{{ $errors->first('luaran') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('id_metadata_terkait', 'ID Metadata SPBE Terkait', ['class' => 'control-label']) }}
            {{ Form::select(
                'id_metadata_terkait',
                $data['metadata_spbe'] ?? [],
                isset($application->id_metadata_terkait) ? $application->id_metadata_terkait : old('id_metadata_terkait'),
                ['class' => $errors->has('id_metadata_terkait') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Metadata SPBE'],
            ) }}
            <small class="text-muted">Mengacu kepada metadata SPBE terkait</small>
            <span style="color:red !important;">{{ $errors->first('id_metadata_terkait') }}</span>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <h4>Data Flow</h4>
        <p>
            Informasi alur data aplikasi.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('inputan_data', 'Inputan Data yang Dibutuhkan', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'inputan_data',
                isset($application->inputan_data) ? $application->inputan_data : old('inputan_data'),
                ['class' => $errors->has('inputan_data') ? 'form-control is-invalid' : 'form-control', 'rows' => 3, 'placeholder' => 'Jelaskan data input yang dibutuhkan aplikasi'],
            ) }}
            <small class="text-muted">Merupakan identifikasi terhadap data yang dibutuhkan (diinput)</small>
            <span style="color:red !important;">{{ $errors->first('inputan_data') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('supplier_data', 'Supplier Data/Penghasil Data', ['class' => 'control-label']) }}
            {{ Form::text('supplier_data', isset($application->supplier_data) ? $application->supplier_data : old('supplier_data'), ['class' => $errors->has('supplier_data') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: Unit A, Unit B']) }}
            <small class="text-muted">Merupakan identifikasi terhadap nama penghasil data</small>
            <span style="color:red !important;">{{ $errors->first('supplier_data') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('luaran_data', 'Luaran Data yang Dihasilkan', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'luaran_data',
                isset($application->luaran_data) ? $application->luaran_data : old('luaran_data'),
                ['class' => $errors->has('luaran_data') ? 'form-control is-invalid' : 'form-control', 'rows' => 3, 'placeholder' => 'Jelaskan data output yang dihasilkan aplikasi'],
            ) }}
            <small class="text-muted">Merupakan identifikasi terhadap data yang dihasilkan</small>
            <span style="color:red !important;">{{ $errors->first('luaran_data') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('customer_data', 'Customer Data/Pengguna Data', ['class' => 'control-label']) }}
            {{ Form::text('customer_data', isset($application->customer_data) ? $application->customer_data : old('customer_data'), ['class' => $errors->has('customer_data') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: Unit C, Unit D']) }}
            <small class="text-muted">Merupakan identifikasi terhadap pengguna data</small>
            <span style="color:red !important;">{{ $errors->first('customer_data') }}</span>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <h4>Aplikasi/Service Terkait</h4>
        <p>
            Aplikasi atau service yang datanya berelasi dengan aplikasi ini.
        </p>
    </div>
    <div class="col-md-4 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_service();" class="btn btn-primary btn-sm m-r-5 m-b-5"><i class="fa fa-plus"></i> Tambah Aplikasi</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nama Aplikasi</label>
        </div>
    </div>
    <div class="col-md-6">
        <label>Nama Data</label>
    </div>
</div>
<div id="document-service">
    @if (isset($data['services']) && count($data['services']) > 0)
        @foreach ($data['services'] as $item)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="service_name[]" class="form-control" value="{{ $item->service_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="text" name="service_data[]" class="form-control tag-it" value="{{ $item->service_data }}">
                </div>
            </div>
            <?php $rowService++; ?>
        @endforeach    
    @else    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="service_name[]" class="form-control" value="{{ old('service_name.'.$rowService) }}">
                </div>
            </div>
            <div class="col-md-6">
                <input type="text" name="service_data[]" class="form-control tag-it" value="{{ old('service_data.0'.$rowService) }}">
            </div>
        </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <h4>Informasi Teknis</h4>
        <p>
            Info mengenai aspek teknis aplikasi Anda ditunjukkan di bawah ini.<br>
            <span class="text-muted">Silakan isi kolom sesuai kebutuhan.</span>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('manufacturer', 'Manufacturer', ['class' => 'control-label']) }}                    {{ Form::text('manufacturer', isset($application->manufacturer) ? $application->manufacturer : old('manufacturer'), ['class' => $errors->has('manufacturer') ? 'form-control is-invalid' : 'form-control']) }}
                    <span style="color:red !important;">{{ $errors->first('manufacturer') }}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('type_hosting', 'Lokasi Server', ['class' => 'control-label']) }}                    {{ Form::select(
                        'type_hosting',
                        [
                            'on_prem' => 'On-prem',
                            'cloud' => 'Cloud',
                            'hybrid' => 'Hybrid',
                            'diskominfo' => 'Di Kominfo',
                            'diluardiskominfo' => 'Diluar Diskominfo'
                        ],
                        isset($application->type_hosting) ? $application->type_hosting : old('type_hosting'),
                        ['class' => $errors->has('type_hosting') ? 'form-control is-invalid' : 'form-control'],
                    ) }}
                    <span style="color:red !important;">{{ $errors->first('type_hosting') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('server_id', 'Server', ['class' => 'control-label']) }}
                    {{ Form::select(
                        'server_id',
                        $data['servers'],
                        isset($application->server_id) ? $application->server_id : old('server_id'),
                        ['class' => $errors->has('server_id') ? 'form-control is-invalid' : 'form-control'],
                    ) }}
                    <span style="color:red !important;">{{ $errors->first('server_id') }}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('ip_address', 'IP Address', ['class' => 'control-label']) }}                    {{ Form::text('ip_address', isset($application->ip_address) ? $application->ip_address : old('ip_address'), ['class' => $errors->has('ip_address') ? 'form-control is-invalid' : 'form-control','placeholder'=> '0:0:0:0']) }}
                    <span style="color:red !important;">{{ $errors->first('ip_address') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('repository', 'Repository (Github,Bitbucket dsb)', ['class' => 'control-label']) }}            {{ Form::text('repository', isset($application->repository) ? $application->repository : old('repository'), ['class' => $errors->has('repository') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('repository') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <h4>Informasi Teknis</h4>
        <p>
            Info mengenai aspek teknis aplikasi Anda ditunjukkan di bawah ini.<br>
            <span class="text-muted">Silakan isi kolom sesuai kebutuhan.</span>
        </p>
        <div class="form-group">
            {{ Form::label('predecessor_app', 'Aplikasi Sebelumnya', ['class' => 'control-label']) }}
            {{ Form::select(
                'predecessor_app',
                $data['inventory'],
                isset($application->predecessor_app) ? $application->predecessor_app : old('type_hosting'),
                ['class' => $errors->has('predecessor_app') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('predecessor_app') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('database', 'Database', ['class' => 'control-label']) }}
            <small class="text-muted">Basis data yang digunakan oleh aplikasi</small>
            {{ Form::select(
                'database',
                $data['databases'],
                isset($application->database) ? $application->database : old('database'),
                ['class' => $errors->has('database') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('database') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('language', 'Bahasa Pemrograman', ['class' => 'control-label']) }}            <small class="text-muted">Bahasa pemrograman yang digunakan oleh aplikasi</small>
            {{ Form::select('language[]',$data['languages'],isset($data['language']) ? $data['language'] : old('language'), ['class' => $errors->has('language') ? 'form-control is-invalid' : 'form-control','id'=>'bahasa-pemrograman','multiple'=>true]) }}
            <span style="color:red !important;">{{ $errors->first('url') }}</span>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <h4>Teknis Lanjutan</h4>
        <p>
            Informasi teknis lanjutan aplikasi.
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('basis_aplikasi', 'Basis Aplikasi', ['class' => 'control-label']) }}
            {{ Form::select(
                'basis_aplikasi',
                [
                    'desktop' => 'Desktop',
                    'web' => 'Web',
                    'cloud' => 'Cloud',
                    'mobile' => 'Mobile'
                ],
                isset($application->basis_aplikasi) ? $application->basis_aplikasi : old('basis_aplikasi'),
                ['class' => $errors->has('basis_aplikasi') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Basis Aplikasi'],
            ) }}
            <small class="text-muted">Basis dari aplikasi (Desktop; Web; Cloud; atau Mobile)</small>
            <span style="color:red !important;">{{ $errors->first('basis_aplikasi') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('server_aplikasi', 'Server Aplikasi', ['class' => 'control-label']) }}
            {{ Form::select(
                'server_aplikasi',
                $data['servers'] ?? [],
                isset($application->server_aplikasi) ? $application->server_aplikasi : old('server_aplikasi'),
                ['class' => $errors->has('server_aplikasi') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Server Aplikasi'],
            ) }}
            <small class="text-muted">Server yang digunakan oleh aplikasi, pilihan server yang digunakan didapat dari metadata perangkat keras server</small>
            <span style="color:red !important;">{{ $errors->first('server_aplikasi') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('tipe_lisensi', 'Tipe Lisensi', ['class' => 'control-label']) }}
            {{ Form::select(
                'tipe_lisensi',
                [
                    'open_source' => 'Open Source',
                    'proprietary' => 'Proprietary'
                ],
                isset($application->tipe_lisensi) ? $application->tipe_lisensi : old('tipe_lisensi'),
                ['class' => $errors->has('tipe_lisensi') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Tipe Lisensi'],
            ) }}
            <small class="text-muted">Tipe lisensi dari aplikasi (Open Source/Proprietary)</small>
            <span style="color:red !important;">{{ $errors->first('tipe_lisensi') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('kerangka_pengembangan', 'Kerangka Pengembangan/Framework', ['class' => 'control-label']) }}
            {{ Form::text('kerangka_pengembangan', isset($application->kerangka_pengembangan) ? $application->kerangka_pengembangan : old('kerangka_pengembangan'), ['class' => $errors->has('kerangka_pengembangan') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Contoh: Laravel, React, Angular']) }}
            <small class="text-muted">Kerangka atau Framework yang digunakan oleh aplikasi</small>
            <span style="color:red !important;">{{ $errors->first('kerangka_pengembangan') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('unit_pengembang', 'Unit Pengembang', ['class' => 'control-label']) }}
            {{ Form::select(
                'unit_pengembang',
                $data['units'] ?? [],
                isset($application->unit_pengembang) ? $application->unit_pengembang : old('unit_pengembang'),
                ['class' => $errors->has('unit_pengembang') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Unit Pengembang'],
            ) }}
            <small class="text-muted">Unit yang melakukan pembangunan dan pengembangan aplikasi</small>
            <span style="color:red !important;">{{ $errors->first('unit_pengembang') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('unit_operasional_teknologi', 'Unit Operasional Teknologi', ['class' => 'control-label']) }}
            {{ Form::select(
                'unit_operasional_teknologi',
                $data['units'] ?? [],
                isset($application->unit_operasional_teknologi) ? $application->unit_operasional_teknologi : old('unit_operasional_teknologi'),
                ['class' => $errors->has('unit_operasional_teknologi') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Pilih Unit Operasional'],
            ) }}
            <small class="text-muted">Unit yang melakukan operasional teknologi layanan</small>
            <span style="color:red !important;">{{ $errors->first('unit_operasional_teknologi') }}</span>
        </div>
    </div>
</div>
<hr>
<h4>Detail Pemilik</h4>
<p>
    Anda dapat menemukan informasi tentang orang-orang yang relevan dengan aplikasi Anda di sini.<br>
    <span class="text-muted">Silakan isi kolom sesuai kebutuhan.</span>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('opd_id', 'OPD', ['class' => 'control-label']) }}            {{ Form::select(
                'opd_id',
                $data['opds'],
                isset($application->opd_id) ? $application->opd_id : old('opd_id'),
                [
                    'class' => $errors->has('opd_id') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('opd_id') }} </span>
        </div>
        <div class="form-group">
            {{ Form::label('sub_unit', 'Sub Unit', ['class' => 'control-label']) }}            {{ Form::select(
                'sub_unit',
                $data['programs'],
                isset($application->sub_unit) ? $application->sub_unit : old('sub_unit'),
                [
                    'class' => $errors->has('sub_unit') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('sub_unit') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('sumber_dana', 'Sumber Dana', ['class' => 'control-label']) }}            {{ Form::select(
                'sumber_dana',
                [
                    'apbd' => 'APBD',
                    'nonapbd' => 'NON APBD'
                ],
                isset($application->sumber_dana) ? $application->sumber_dana : old('sumber_dana'),
                [
                    'class' => $errors->has('sumber_dana') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('sumber_dana') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('tahun_pembuatan', 'Tahun Pembangunan', ['class' => 'control-label']) }}            {{ Form::number('tahun_pembuatan', isset($application->tahun_pembuatan) ? $application->tahun_pembuatan : old('tahun_pembuatan'), ['class' => $errors->has('tahun_pembuatan') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('tahun_pembuatan') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('tahun_anggaran', 'Tahun Anggaran/Tahun Pembangunan', ['class' => 'control-label']) }}            {{ Form::number('tahun_anggaran', isset($application->tahun_anggaran) ? $application->tahun_anggaran : old('tahun_anggaran'), ['class' => $errors->has('tahun_anggaran') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('tahun_anggaran') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('harga', 'Lisensi/Biaya', ['class' => 'control-label']) }}
            {{ Form::number('harga', isset($application->harga) ? $application->harga : old('harga'), ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('harga') }}</span>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <h4>Surat Permohonan Dinas</h4>
        <p>
            Anda dapat menambahkan Dokumen Surat Permohonan Dinas.
        </p>
    </div>
    <div class="col-md-4 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_document_spd();" class="btn btn-primary btn-sm m-r-5 m-b-5"><i
                class="fa fa-plus"></i> Tambah Dokumen/Link</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="document-spd">
            @if (isset($data['documents']) && count($data['documents']) > 0)
                @foreach ($data['documents'] as $item)
                    @if ($item->inventory === 'application-spd')
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn"><a data-input="doc_spd{{ $rowSpd }}"
                                        data-preview="holder" class="btn btn-success lfm-spd"><i class="fa fa-file"></i>
                                        Pilih...</a></span>
                                {{ Form::text('doc_spd[' . $rowSpd . ']', $item->url, ['class' => 'form-control', 'id' => 'doc_spd' . $rowSpd]) }}
                            </div>
                        </div>
                        <?php $rowSpd++; ?>
                    @endif
                @endforeach
                @if ($rowSpd === 1)
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn"><a data-input="doc_spd1" data-preview="holder"
                                    class="btn btn-success lfm-spd"><i class="fa fa-file"></i> Pilih...</a></span>
                            {{ Form::text('doc_spd[1]', null, ['class' => 'form-control', 'id' => 'doc_spd1']) }}
                        </div>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn"><a data-input="doc_spd1" data-preview="holder"
                                class="btn btn-success lfm-spd"><i class="fa fa-file"></i> Pilih...</a></span>
                        {{ Form::text('doc_spd[1]', null, ['class' => 'form-control', 'id' => 'doc_spd1']) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <h4>Tambahkan Dokumen KAK</h4>
        <p>
            Anda dapat menambahkan dokumen atau link KAK (Kerangka Acuan Kerja) dan menyimpan data Anda
        </p>
    </div>
    <div class="col-md-4 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_document_kmk();" class="btn btn-primary btn-sm m-r-5 m-b-5"><i
                class="fa fa-plus"></i> Tambah Dokumen/Link</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="document-kmk">
            @if (isset($data['documents']) && count($data['documents']) > 0)
                @foreach ($data['documents'] as $item)
                    @if ($item->inventory === 'application-kmk')
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn"><a data-input="doc_kmk{{ $rowKmk }}"
                                        data-preview="holder" class="btn btn-success lfm-kak"><i class="fa fa-file"></i>
                                        Pilih...</a></span>
                                {{ Form::text('doc_kmk[' . $rowKmk . ']', $item->url, ['class' => 'form-control', 'id' => 'doc_kmk' . $rowKmk]) }}
                            </div>
                        </div>
                        <?php $rowKmk++; ?>
                    @endif
                @endforeach
                @if ($rowKmk === 1)
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn"><a data-input="doc_kmk1" data-preview="holder"
                                    class="btn btn-success lfm-kak"><i class="fa fa-file"></i> Pilih...</a></span>
                            {{ Form::text('doc_kmk[1]', null, ['class' => 'form-control', 'id' => 'doc_kmk1']) }}
                        </div>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn"><a data-input="doc_kmk1" data-preview="holder"
                                class="btn btn-success lfm-kak"><i class="fa fa-file"></i> Pilih...</a></span>
                        {{ Form::text('doc_kmk[1]', null, ['class' => 'form-control', 'id' => 'doc_kmk1']) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <h4>Tambahkan Dokumen Proses Bisnis</h4>
        <p>
            Anda dapat menambahkan dokumen atau link Proses Bisnis dan menyimpan data Anda
        </p>
    </div>
    <div class="col-md-4 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_document_probis();" class="btn btn-primary btn-sm m-r-5 m-b-5"><i
                class="fa fa-plus"></i> Tambah Dokumen/Link</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="document-probis">
            @if (isset($data['documents']) && count($data['documents']) > 0)
                @foreach ($data['documents'] as $item)
                    @if ($item->inventory === 'application-probis')
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn"><a data-input="doc_probis{{ $rowProbis }}"
                                        data-preview="holder" class="btn btn-success lfm-kak"><i
                                            class="fa fa-file"></i>
                                        Pilih...</a></span>
                                {{ Form::text('doc_probis[' . $rowProbis . ']', $item->url, ['class' => 'form-control', 'id' => 'doc_probis' . $rowProbis]) }}
                            </div>
                        </div>
                        <?php $rowProbis++; ?>
                    @endif
                @endforeach
                @if ($rowProbis === 1)
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn"><a data-input="doc_probis1" data-preview="holder"
                                    class="btn btn-success lfm-probis"><i class="fa fa-file"></i> Pilih...</a></span>
                            {{ Form::text('doc_probis[1]', null, ['class' => 'form-control', 'id' => 'doc_probis1']) }}
                        </div>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn"><a data-input="doc_probis1" data-preview="holder"
                                class="btn btn-success lfm-probis"><i class="fa fa-file"></i> Pilih...</a></span>
                        {{ Form::text('doc_probis[1]', null, ['class' => 'form-control', 'id' => 'doc_probis1']) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <h4>Tambahkan Dokumen Manual Book</h4>
        <p>
            Anda dapat menambahkan dokumen atau link Proses Bisnis dan menyimpan data Anda
        </p>
    </div>
    <div class="col-md-4 col-sm-12 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_document_manual();" class="btn btn-primary btn-sm m-r-5 m-b-5"><i
                class="fa fa-plus"></i> Tambah Dokumen/Link</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="document-manual">
            @if (isset($data['documents']) && count($data['documents']) > 0)
                @foreach ($data['documents'] as $item)
                    @if ($item->inventory === 'application-manual')
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn"><a data-input="doc_manual{{ $rowManual }}"
                                        data-preview="holder" class="btn btn-success lfm-kak"><i
                                            class="fa fa-file"></i>
                                        Pilih...</a></span>
                                {{ Form::text('doc_manual[' . $rowManual . ']', $item->url, ['class' => 'form-control', 'id' => 'doc_manual' . $rowManual]) }}
                            </div>
                        </div>
                        <?php $rowManual++; ?>
                    @endif
                @endforeach
                @if ($rowManual === 1)
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn"><a data-input="doc_manual1" data-preview="holder"
                                    class="btn btn-success lfm-manual"><i class="fa fa-file"></i> Pilih...</a></span>
                            {{ Form::text('doc_manual[1]', null, ['class' => 'form-control', 'id' => 'doc_manual1']) }}
                        </div>
                    </div>
                @endif
            @else
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-btn"><a data-input="doc_manual1" data-preview="holder"
                                class="btn btn-success lfm-manual"><i class="fa fa-file"></i> Pilih...</a></span>
                        {{ Form::text('doc_manual[1]', null, ['class' => 'form-control', 'id' => 'doc_manual1']) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="form-group has-error has-feedback">
    <div class="col-md-12 text-right">
        <a href="{{ route('master.category.index') }}" class="btn btn-sm btn-default  m-r-5">Cancel</a>
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>
