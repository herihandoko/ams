@extends('page')
@section('title', 'Dashboard')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Dashboard <small>Application Management Software</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>TOTAL APPLICATIONS</h4>
                    <p>{{ number_format($app_all, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index') }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>ACTIVE APPLICATIONS</h4>
                    <p>{{ number_format($app_active, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index', ['status' => 'active']) }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>TOTAL HARDWARE</h4>
                    <p>{{ number_format($hardware, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.hardware.index') }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-archive"></i></div>
                <div class="stats-info">
                    <h4>ARCHIVED APPLICATIONS</h4>
                    <p>{{ number_format($app_inactive, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index', ['status' => 'inactive']) }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-database"></i></div>
                <div class="stats-info">
                    <h4>MASTER DATA</h4>
                    <p>{{ number_format($data_metadata, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('master.data_metadata.index') }}" onclick="scrollToMasterData()">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <!-- end row -->
    
    <!-- Master Data Overview Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title"><i class="fa fa-database"></i> Master Data Overview</h4>
                </div>
                <div class="panel-body">
                    <div class="row" id="master-data-section">
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-blue">
                                <div class="stats-icon"><i class="fa fa-building"></i></div>
                                <div class="stats-info">
                                    <h4>Units</h4>
                                    <p>{{ number_format($master_data_stats['units'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.unit.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-green">
                                <div class="stats-icon"><i class="fa fa-cogs"></i></div>
                                <div class="stats-info">
                                    <h4>Layanan</h4>
                                    <p>{{ number_format($master_data_stats['layanan'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.layanan.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-purple">
                                <div class="stats-icon"><i class="fa fa-cloud"></i></div>
                                <div class="stats-info">
                                    <h4>Government Cloud</h4>
                                    <p>{{ number_format($master_data_stats['government_cloud'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.government_cloud.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-orange">
                                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                                <div class="stats-info">
                                    <h4>Software Platform</h4>
                                    <p>{{ number_format($master_data_stats['software_platform'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.software_platform.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-info">
                                <div class="stats-icon"><i class="fa fa-server"></i></div>
                                <div class="stats-info">
                                    <h4>Servers</h4>
                                    <p>{{ number_format($master_data_stats['servers'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.servers.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-warning">
                                <div class="stats-icon"><i class="fa fa-hdd-o"></i></div>
                                <div class="stats-info">
                                    <h4>Storage Media</h4>
                                    <p>{{ number_format($master_data_stats['storage_media'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.storage_media.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-success">
                                <div class="stats-icon"><i class="fa fa-list-alt"></i></div>
                                <div class="stats-info">
                                    <h4>Metadata SPBE</h4>
                                    <p>{{ number_format($master_data_stats['metadata_spbe'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.metadata_spbe.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="widget widget-stats bg-danger">
                                <div class="stats-icon"><i class="fa fa-table"></i></div>
                                <div class="stats-info">
                                    <h4>Data Metadata</h4>
                                    <p>{{ number_format($master_data_stats['data_metadata'], 0) }}</p>
                                </div>
                                <div class="stats-link">
                                    <a href="{{ route('master.data_metadata.index') }}">View <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-md-8">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"><i class="fa fa-money"></i> Top Applications by Cost</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Application Name</th>
                                    <th>Cost (IDR)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_apps_by_cost as $index => $app)
                                    <tr>
                                        <td><span class="label label-{{ $index == 0 ? 'danger' : ($index == 1 ? 'warning' : 'info') }}">{{ $index + 1 }}</span></td>
                                        <td><strong>{{ $app->name }}</strong></td>
                                        <td><span class="text-success">Rp {{ number_format($app->harga, 0, ',', '.') }}</span></td>
                                        <td><span class="label label-success">Active</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No cost data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"><i class="fa fa-clock-o"></i> Recent Applications</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Application Name</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_apps as $app)
                                    <tr>
                                        <td><strong>{{ $app->name }}</strong></td>
                                        <td>
                                            @if($app->status == 'active')
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $app->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('inventory.application.show', $app->id) }}" class="btn btn-xs btn-info">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No recent applications</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">OPD Application Graphic</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama OPD</th>
                                <th>Total Aplikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Hosting Type Application</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-valign-middle m-b-0">
                        <thead>
                            <tr>
                                <th>Hosting Type</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label class="label label-danger">On-prem</label></td>
                                <td>{{ $hosting_type['on_prem'] }} <span class="text-success"><i
                                            class="fa fa-arrow-up"></i></span></td>
                            </tr>
                            <tr>
                                <td><label class="label label-warning">Cloud</label></td>
                                <td>{{ $hosting_type['cloud'] }} <span class="text-danger"><i
                                            class="fa fa-arrow-down"></i></span></td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">Hybrid</label></td>
                                <td>{{ $hosting_type['hybrid'] }} <span class="text-success"><i
                                            class="fa fa-arrow-up"></i></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Application Status</h4>
                </div>
                <div class="panel-body">
                    <canvas id="application-status"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<style>
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-info {
    background-color: #17a2b8 !important;
}
.bg-warning {
    background-color: #ffc107 !important;
}
.bg-success {
    background-color: #28a745 !important;
}
.bg-danger {
    background-color: #dc3545 !important;
}
</style>
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var appStatus = document.getElementById('application-status').getContext("2d");
        getAplikasiStatus(appStatus);
        
        // Function to scroll to master data section
        function scrollToMasterData() {
            document.getElementById('master-data-section').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            pageLength: 5,
            ajax: {
                url: "{{ route('home.opdapp') }}",
                type: "GET"
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'inventory_count',
                    name: 'inventory_count'
                }
            ],
        });



        function getAplikasiStatus(appStatus) {
            $.ajax({
                type: "get",
                url: "{{ route('home.stsapp') }}",
                dataType: 'JSON',
                success: function(data) {
                    if (data.success) {
                        var myChart = new Chart(appStatus, {
                            type: 'doughnut',
                            data: data.data,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: false,
                                        text: 'Chart.js Doughnut Chart'
                                    }
                                }
                            },
                        });
                    }
                }
            });
        }
    </script>
@endsection
