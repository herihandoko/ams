@extends('page')

@section('title', 'Metadata Komputasi Awan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="{{ route('master.government_cloud.create') }}" class="btn btn-xs btn-icon btn-circle btn-primary"><i class="fa fa-plus"></i></a>
                </div>
                <h4 class="panel-title">Metadata Komputasi Awan</h4>
            </div>
            <div class="panel-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Government Cloud</th>
                                <th>Tipe</th>
                                <th>Status Kepemilikan</th>
                                <th>Unit Pengembang</th>
                                <th>Unit Operasional</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($governmentClouds as $index => $cloud)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cloud->nama_government_cloud }}</td>
                                    <td>
                                        @switch($cloud->tipe_government_cloud)
                                            @case('paas')
                                                <span class="label label-primary">PaaS</span>
                                                @break
                                            @case('iaas')
                                                <span class="label label-success">IaaS</span>
                                                @break
                                            @case('saas')
                                                <span class="label label-info">SaaS</span>
                                                @break
                                            @case('bdaas')
                                                <span class="label label-warning">BDaaS</span>
                                                @break
                                            @case('secaas')
                                                <span class="label label-danger">SecaaS</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($cloud->status_kepemilikan)
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
                                    <td>{{ $cloud->unitPengembang->nama_unit ?? '-' }}</td>
                                    <td>{{ $cloud->unitOperasional->nama_unit ?? '-' }}</td>
                                    <td>
                                        @if($cloud->status == 'active')
                                            <span class="label label-success">Aktif</span>
                                        @else
                                            <span class="label label-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('master.government_cloud.show', $cloud->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('master.government_cloud.edit', $cloud->id) }}" class="btn btn-xs btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('master.government_cloud.destroy', $cloud->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data Government Cloud</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    {{ $governmentClouds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
