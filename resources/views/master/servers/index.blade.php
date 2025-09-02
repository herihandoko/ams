@extends('page')
@section('title', 'Users')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Master</a></li>
        <li class="active">Server</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Server <small>List</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        @can('create', $data['moduleCode'])
                            <a href="{{ route('master.servers.create') }}"
                                class="btn btn-xs btn-icon btn-circle btn-primary btn-action-add"><i class="fa fa-plus"></i></a>
                        @endcan
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Server - list</h4>
                </div>
                <div class="panel-body">
                    @include('master.message')
                    <table id="data-table" class="table table-striped table-bordered responsive" width="100%">
                        <thead>
                            <tr>
                                <th>STATUS</th>
                                <th>ID</th>
                                <th>NAMA SERVER</th>
                                <th>TYPE</th>
                                <th>IP</th>
                                <th>JENIS PENGGUNAAN</th>
                                <th>STATUS KEPEMILIKAN</th>
                                <th>UNIT PENGELOLA</th>
                                <th>HDD</th>
                                <th>RAM</th>
                                <th>CPU</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('master.servers.fetch') !!}",
                columns: [{
                        data: 'status',
                        width: 32,
                        name: 'status'
                    },
                    {
                        data: 'id',
                        width: 75,
                        name: 'id'
                    },
                    {
                        data: 'nama_server',
                        name: 'nama_server'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'ip',
                        name: 'ip'
                    },
                    {
                        data: 'jenis_penggunaan_server',
                        name: 'jenis_penggunaan_server'
                    },
                    {
                        data: 'status_kepemilikan',
                        name: 'status_kepemilikan'
                    },
                    {
                        data: 'unit_pengelola',
                        name: 'unit_pengelola'
                    },
                    {
                        data: 'hdd',
                        name: 'hdd'
                    },
                    {
                        data: 'ram',
                        name: 'ram'
                    },
                    {
                        data: 'cpu',
                        name: 'cpu'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: 100,
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('body').on('click', '.btn-action-delete', function() {
                var id = $(this).data("id");
                swal({
                        title: "Apa Anda Yakin?",
                        text: "Data yang sudah di hapus, tidak bisa di kembalikan lagi!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus data ini!",
                        closeOnConfirm: false
                    },
                    function(result) {
                        if (result) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route('master.servers.destroy') }}",
                                dataType: 'JSON',
                                data: {
                                    'id': id,
                                },
                                success: function(data) {
                                    swal("Berhasil!", "Data berhasil dihapus.",
                                        "success");
                                    $('#data-table').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection
