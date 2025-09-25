@extends('page')
@section('title', 'Dashboard OPD')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Dashboard OPD</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Dashboard <small>{{ $opd_name }}</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- Stats Cards -->
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-desktop fa-2x"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <h3 class="m-t-0">{{ $total_apps }}</h3>
                    <p class="text-muted">Total Aplikasi</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-check-circle fa-2x"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <h3 class="m-t-0">{{ $active_apps }}</h3>
                    <p class="text-muted">Aplikasi Aktif</p>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-building fa-2x"></i>
                    </div>
                </div>
                <div class="panel-body">
                    <h5 class="m-t-0">{{ $opd_name }}</h5>
                    <p class="text-muted">Organisasi Perangkat Daerah</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    
    <!-- begin row -->
    <div class="row">
        <!-- Platform Distribution -->
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Distribusi Platform</h4>
                </div>
                <div class="panel-body">
                    <canvas id="platformChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Service Distribution -->
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Layanan yang Didukung</h4>
                </div>
                <div class="panel-body">
                    <canvas id="serviceChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Aksi Cepat</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('inventory.application.index') }}" class="btn btn-primary btn-block">
                                <i class="fa fa-list"></i> Lihat Semua Aplikasi
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('inventory.application.create') }}" class="btn btn-success btn-block">
                                <i class="fa fa-plus"></i> Tambah Aplikasi Baru
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('inventory.application.index', ['status' => 'active']) }}" class="btn btn-info btn-block">
                                <i class="fa fa-check-circle"></i> Aplikasi Aktif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Platform Chart
    const platformCtx = document.getElementById('platformChart').getContext('2d');
    new Chart(platformCtx, {
        type: 'doughnut',
        data: {
            labels: ['Web', 'Mobile', 'Desktop'],
            datasets: [{
                data: [{{ $platform_stats['web'] }}, {{ $platform_stats['mobile'] }}, {{ $platform_stats['desktop'] }}],
                backgroundColor: ['#3498db', '#2ecc71', '#e74c3c'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    
    // Service Chart
    const serviceCtx = document.getElementById('serviceChart').getContext('2d');
    new Chart(serviceCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($service_stats['labels']) !!},
            datasets: [{
                data: {!! json_encode($service_stats['data']) !!},
                backgroundColor: ['#f39c12', '#9b59b6', '#1abc9c', '#e74c3c', '#3498db', '#2ecc71'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
@endsection
