@extends('page')

@section('title', 'Detail Metadata Komputasi Awan')

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
                <h4 class="panel-title">Detail Metadata Komputasi Awan</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Nama Government Cloud</strong></td>
                                <td>: {{ $governmentCloud->nama_government_cloud }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tipe Government Cloud</strong></td>
                                <td>: 
                                    @switch($governmentCloud->tipe_government_cloud)
                                        @case('paas')
                                            <span class="label label-primary">PaaS (Platform as a Service)</span>
                                            @break
                                        @case('iaas')
                                            <span class="label label-success">IaaS (Infrastructure as a Service)</span>
                                            @break
                                        @case('saas')
                                            <span class="label label-info">SaaS (Software as a Service)</span>
                                            @break
                                        @case('bdaas')
                                            <span class="label label-warning">BDaaS (Big Data as a Service)</span>
                                            @break
                                        @case('secaas')
                                            <span class="label label-danger">SecaaS (Security as a Service)</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status Kepemilikan</strong></td>
                                <td>: 
                                    @switch($governmentCloud->status_kepemilikan)
                                        @case('milik_sendiri')
                                            <span class="label label-success">Milik Sendiri</span>
                                            @break
                                        @case('milik_instansi_pemerintah_lain')
                                            <span class="label label-info">Milik Instansi Pemerintah Lain</span>
                                            @break
                                        @case('milik_bumn')
                                            <span class="label label-warning">Milik BUMN</span>
                                            @break
                                        @case('milik_pihak_ketiga')
                                            <span class="label label-danger">Milik Pihak Ketiga</span>
                                            @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Pemilik</strong></td>
                                <td>: {{ $governmentCloud->nama_pemilik ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Biaya Layanan</strong></td>
                                <td>: {{ $governmentCloud->biaya_layanan ? 'Rp ' . number_format($governmentCloud->biaya_layanan, 2, ',', '.') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Unit Pengembang</strong></td>
                                <td>: {{ $governmentCloud->unitPengembang->nama_unit ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Unit Operasional</strong></td>
                                <td>: {{ $governmentCloud->unitOperasional->nama_unit ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jangka Waktu Pelayanan</strong></td>
                                <td>: {{ $governmentCloud->jangka_waktu_pelayanan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Metadata SPBE Terkait</strong></td>
                                <td>: {{ $governmentCloud->metadataSpbe->nama_metadata ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                    @if($governmentCloud->status == 'active')
                                        <span class="label label-success">Aktif</span>
                                    @else
                                        <span class="label label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat Pada</strong></td>
                                <td>: {{ $governmentCloud->created_at ? $governmentCloud->created_at->format('d/m/Y H:i:s') : '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate Pada</strong></td>
                                <td>: {{ $governmentCloud->updated_at ? $governmentCloud->updated_at->format('d/m/Y H:i:s') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Deskripsi</strong></td>
                                <td>: {{ $governmentCloud->deskripsi_government_cloud ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('master.government_cloud.index') }}" class="btn btn-default">Kembali</a>
                            <a href="{{ route('master.government_cloud.edit', $governmentCloud->id) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
