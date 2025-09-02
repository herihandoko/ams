@extends('page')

@section('title', 'Edit Metadata Komputasi Awan')

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
                <h4 class="panel-title">Edit Metadata Komputasi Awan</h4>
            </div>
            <div class="panel-body">
                <form action="{{ route('master.government_cloud.update', $governmentCloud->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_government_cloud">Nama Government Cloud <span class="text-danger">*</span></label>
                                <input type="text" name="nama_government_cloud" id="nama_government_cloud" class="form-control @error('nama_government_cloud') is-invalid @enderror" value="{{ old('nama_government_cloud', $governmentCloud->nama_government_cloud) }}" required>
                                <small class="text-muted">Nama Government Cloud yang digunakan</small>
                                @error('nama_government_cloud')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tipe_government_cloud">Tipe Government Cloud <span class="text-danger">*</span></label>
                                <select name="tipe_government_cloud" id="tipe_government_cloud" class="form-control @error('tipe_government_cloud') is-invalid @enderror" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="paas" {{ old('tipe_government_cloud', $governmentCloud->tipe_government_cloud) == 'paas' ? 'selected' : '' }}>PaaS (Platform as a Service)</option>
                                    <option value="iaas" {{ old('tipe_government_cloud', $governmentCloud->tipe_government_cloud) == 'iaas' ? 'selected' : '' }}>IaaS (Infrastructure as a Service)</option>
                                    <option value="saas" {{ old('tipe_government_cloud', $governmentCloud->tipe_government_cloud) == 'saas' ? 'selected' : '' }}>SaaS (Software as a Service)</option>
                                    <option value="bdaas" {{ old('tipe_government_cloud', $governmentCloud->tipe_government_cloud) == 'bdaas' ? 'selected' : '' }}>BDaaS (Big Data as a Service)</option>
                                    <option value="secaas" {{ old('tipe_government_cloud', $governmentCloud->tipe_government_cloud) == 'secaas' ? 'selected' : '' }}>SecaaS (Security as a Service)</option>
                                </select>
                                <small class="text-muted">Jenis dari Government Cloud yang digunakan (PaaS, IaaS, SaaS, BDaaS, dan SecaaS)</small>
                                @error('tipe_government_cloud')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status_kepemilikan">Status Kepemilikan <span class="text-danger">*</span></label>
                                <select name="status_kepemilikan" id="status_kepemilikan" class="form-control @error('status_kepemilikan') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="milik_sendiri" {{ old('status_kepemilikan', $governmentCloud->status_kepemilikan) == 'milik_sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                    <option value="milik_instansi_pemerintah_lain" {{ old('status_kepemilikan', $governmentCloud->status_kepemilikan) == 'milik_instansi_pemerintah_lain' ? 'selected' : '' }}>Milik Instansi Pemerintah Lain</option>
                                    <option value="milik_bumn" {{ old('status_kepemilikan', $governmentCloud->status_kepemilikan) == 'milik_bumn' ? 'selected' : '' }}>Milik BUMN</option>
                                    <option value="milik_pihak_ketiga" {{ old('status_kepemilikan', $governmentCloud->status_kepemilikan) == 'milik_pihak_ketiga' ? 'selected' : '' }}>Milik Pihak Ketiga</option>
                                </select>
                                <small class="text-muted">Status kepemilikan dari Government Cloud yang digunakan</small>
                                @error('status_kepemilikan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_pemilik">Nama Pemilik</label>
                                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik', $governmentCloud->nama_pemilik) }}">
                                <small class="text-muted">Nama pemilik Government Cloud yang digunakan, diisi jika pilihan pada status kepemilikan selain milik sendiri</small>
                                @error('nama_pemilik')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="biaya_layanan">Biaya Layanan</label>
                                <input type="number" name="biaya_layanan" id="biaya_layanan" class="form-control @error('biaya_layanan') is-invalid @enderror" value="{{ old('biaya_layanan', $governmentCloud->biaya_layanan) }}" step="0.01" min="0">
                                <small class="text-muted">Biaya yang dikeluarkan pemilik untuk layanan Government Cloud</small>
                                @error('biaya_layanan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_pengembang_id">Unit Pengembang Government Cloud</label>
                                <select name="unit_pengembang_id" id="unit_pengembang_id" class="form-control @error('unit_pengembang_id') is-invalid @enderror">
                                    <option value="">Pilih Unit Pengembang</option>
                                    @foreach($data['units'] as $id => $nama)
                                        <option value="{{ $id }}" {{ old('unit_pengembang_id', $governmentCloud->unit_pengembang_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Unit yang melakukan pembangunan dan pengembangan Government Cloud</small>
                                @error('unit_pengembang_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="unit_operasional_id">Unit Operasional Government Cloud</label>
                                <select name="unit_operasional_id" id="unit_operasional_id" class="form-control @error('unit_operasional_id') is-invalid @enderror">
                                    <option value="">Pilih Unit Operasional</option>
                                    @foreach($data['units'] as $id => $nama)
                                        <option value="{{ $id }}" {{ old('unit_operasional_id', $governmentCloud->unit_operasional_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Unit operasional Government Cloud yang digunakan</small>
                                @error('unit_operasional_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jangka_waktu_pelayanan">Jangka Waktu Pelayanan</label>
                                <input type="text" name="jangka_waktu_pelayanan" id="jangka_waktu_pelayanan" class="form-control @error('jangka_waktu_pelayanan') is-invalid @enderror" value="{{ old('jangka_waktu_pelayanan', $governmentCloud->jangka_waktu_pelayanan) }}" placeholder="Contoh: 1 tahun, 6 bulan">
                                <small class="text-muted">Periode penggunaan layanan Government Cloud</small>
                                @error('jangka_waktu_pelayanan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_metadata_terkait">ID Metadata Terkait</label>
                                <select name="id_metadata_terkait" id="id_metadata_terkait" class="form-control @error('id_metadata_terkait') is-invalid @enderror">
                                    <option value="">Pilih Metadata SPBE</option>
                                    @foreach($data['metadata_spbe'] as $id => $nama)
                                        <option value="{{ $id }}" {{ old('id_metadata_terkait', $governmentCloud->id_metadata_terkait) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Mengacu kepada metadata SPBE terkait</small>
                                @error('id_metadata_terkait')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi_government_cloud">Deskripsi Government Cloud</label>
                                <textarea name="deskripsi_government_cloud" id="deskripsi_government_cloud" class="form-control @error('deskripsi_government_cloud') is-invalid @enderror" rows="4">{{ old('deskripsi_government_cloud', $governmentCloud->deskripsi_government_cloud) }}</textarea>
                                <small class="text-muted">Penjelasan dari Government Cloud yang digunakan</small>
                                @error('deskripsi_government_cloud')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ route('master.government_cloud.index') }}" class="btn btn-default">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
