<h4>Detail Aplikasi</h4>
<p>
    Anda dapat memeriksa semua informasi aplikasi Anda di bawah.<br>
    <span class="text-danger">* Silakan isi kolom yang wajib diisi.</span>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('code', 'Kode Aplikasi', ['class' => 'control-label']) }}
            {{ Form::text('code', isset($application->code) ? $application->code : (old('code') ? old('code') : $data['code']), ['class' => $errors->has('code') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('code') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('name', 'Nama Aplikasi', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::text('name', isset($application->name) ? $application->name : old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('version', 'Versi', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::text('version', isset($application->version) ? $application->version : old('version'), ['class' => $errors->has('version') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('version') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('user_base', 'Basis pengguna', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::select(
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
            <span style="color:red !important;">{{ $errors->first('user_base') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('scope', 'Scope', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'scope',
                [
                    'publik' => 'Publik',
                    'instansi' => 'Instansi',
                ],
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
            {{ Form::label('url', 'Domain/Package/URL', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::text('url', isset($application->url) ? $application->url : old('url'), ['class' => $errors->has('url') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('url') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('category', 'Kategori', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'category',
                $data['categories'],
                isset($application->category_id) ? $application->category_id : old('category'),
                ['class' => $errors->has('category') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('category') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('status', 'Status Aplikasi', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::select(
                'status',
                [
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                ],
                isset($application->status) ? $application->status : old('status'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('status') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('platform', 'Platform', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'platform',
                [
                    'web' => 'Web',
                    'android' => 'Android',
                    'ios' => 'iOS',
                    'mweb' => 'M-Web',
                ],
                isset($application->platform) ? $application->platform : old('platform'),
                ['class' => $errors->has('platform') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('platform') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Keterangan', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'description',
                isset($application->keterangan) ? $application->keterangan : old('description'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control', 'rows' => 4],
            ) }}
            <span style="color:red !important;">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <h4>Informasi Teknis</h4>
        <p>
            Info mengenai aspek teknis aplikasi Anda ditunjukkan di bawah ini.<br>
            <span class="text-danger">* Silakan isi kolom yang wajib diisi.</span>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('manufacturer', 'Manufacturer', ['class' => 'control-label']) }} <span
                        class="text-danger">*</span>
                    {{ Form::text('manufacturer', isset($application->manufacturer) ? $application->manufacturer : old('manufacturer'), ['class' => $errors->has('manufacturer') ? 'form-control is-invalid' : 'form-control']) }}
                    <span style="color:red !important;">{{ $errors->first('manufacturer') }}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('type_hosting', 'Jenis Hosting', ['class' => 'control-label']) }} <span
                        class="text-danger">*</span>
                    {{ Form::select(
                        'type_hosting',
                        [
                            'on_prem' => 'On-prem',
                            'cloud' => 'Cloud',
                            'hybrid' => 'Hybrid',
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
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h4>Informasi Teknis</h4>
        <p>
            Info mengenai aspek teknis aplikasi Anda ditunjukkan di bawah ini.<br>
            <span class="text-danger">* Silakan isi kolom yang wajib diisi.</span>
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
    </div>
</div>
<hr>
<h4>Detail Pemilik</h4>
<p>
    Anda dapat menemukan informasi tentang orang-orang yang relevan dengan aplikasi Anda di sini.<br>
    <span class="text-danger">* Silakan isi kolom yang wajib diisi.</span>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('opd_id', 'OPD', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'opd_id',
                $data['opds'],
                isset($application->opd_id) ? $application->opd_id : old('type_hosting'),
                [
                    'class' => $errors->has('opd_id') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('opd_id') }} </span>
        </div>
        <div class="form-group">
            {{ Form::label('sub_unit', 'Sub Unit', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'sub_unit',
                $data['programs'],
                isset($application->sub_unit) ? $application->sub_unit : old('type_hosting'),
                [
                    'class' => $errors->has('sub_unit') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('sub_unit') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('tahun_anggaran', 'Tahun Anggaran', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::number('tahun_anggaran', isset($application->tahun_anggaran) ? $application->tahun_anggaran : old('tahun_anggaran'), ['class' => $errors->has('tahun_anggaran') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('tahun_anggaran') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('harga', 'Harga/Lisensi', ['class' => 'control-label']) }}
            {{ Form::number('harga', isset($application->harga) ? $application->harga : old('harga'), ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('harga') }}</span>
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
        <button type="button" onclick="add_document_kmk();" class="btn btn-primary btn-sm m-r-5"><i
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
        <button type="button" onclick="add_document_probis();" class="btn btn-primary btn-sm m-r-5"><i
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
    <div class="col-md-8">
        <h4>Tambahkan Dokumen Manual Book</h4>
        <p>
            Anda dapat menambahkan dokumen atau link Proses Bisnis dan menyimpan data Anda
        </p>
    </div>
    <div class="col-md-4 text-right justify-content-center align-items-center">
        <button type="button" onclick="add_document_manual();" class="btn btn-primary btn-sm m-r-5"><i
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
