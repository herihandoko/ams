<?php

namespace App\Http\Controllers;

use App\Hardware;
use App\Inventory;
use App\Opd;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use DataTables;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{

    use ApiTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        
        // Check if user has OPD role
        if ($user->role_id && \App\Model\Roles::find($user->role_id)->name === 'User OPD') {
            return $this->opdDashboard();
        }
        
        // Default admin dashboard
        return $this->adminDashboard();
    }
    
    private function adminDashboard()
    {
        // Inventory stats
        $appAll = Inventory::where('status', 'active')->count();
        $appActive = Inventory::where('status', 'active')->count();
        $appInactive = Inventory::where('status', 'inactive')->count();
        $hardware = Hardware::count();
        
        // Hosting type stats
        $onprem = Inventory::where('type_hosting', 'on_prem')->count();
        $hybrid = Inventory::where('type_hosting', 'hybrid')->count();
        $cloud = Inventory::where('type_hosting', 'cloud')->count();
        
        // Master data stats
        $totalUnits = \App\Unit::where('status', 'aktif')->count();
        $totalLayanan = \App\Layanan::where('status', 'aktif')->count();
        $totalMetadataSpbe = \App\MetadataSpbe::where('status', 'aktif')->count();
        $totalDataMetadata = \App\DataMetadata::where('status', 'aktif')->count();
        $totalGovernmentCloud = \App\GovernmentCloud::where('status', 'active')->count();
        $totalSoftwarePlatform = \App\SoftwarePlatform::where('status', 'active')->count();
        $totalServers = \App\Servers::where('status', 'active')->count();
        $totalStorageMedia = \App\StorageMedia::where('status', 'active')->count();
        
        // Top applications by cost
        $topAppsByCost = Inventory::select('name', 'harga')
            ->where('harga', '>', 0)
            ->orderBy('harga', 'desc')
            ->take(5)
            ->get();
            
        // Recent applications
        $recentApps = Inventory::select('id', 'name', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Master data distribution
        $masterDataStats = [
            'units' => $totalUnits,
            'layanan' => $totalLayanan,
            'metadata_spbe' => $totalMetadataSpbe,
            'data_metadata' => $totalDataMetadata,
            'government_cloud' => $totalGovernmentCloud,
            'software_platform' => $totalSoftwarePlatform,
            'servers' => $totalServers,
            'storage_media' => $totalStorageMedia
        ];
        
        return view('home', [
            'app_all' => $appAll,
            'app_active' => $appActive,
            'app_inactive' => $appInactive,
            'hardware' => $hardware,
            'hosting_type' => [
                'on_prem' => $onprem,
                'hybrid' => $hybrid,
                'cloud' => $cloud
            ],
            'master_data_stats' => $masterDataStats,
            'data_metadata' => $totalDataMetadata,
            'top_apps_by_cost' => $topAppsByCost,
            'recent_apps' => $recentApps
        ]);
    }
    
    private function opdDashboard()
    {
        $user = auth()->user();
        
        // Get OPD-specific data
        $opdName = $user->opd->name ?? 'OPD Anda';
        
        // Inventory stats for this OPD
        $totalApps = Inventory::where('opd_id', $user->opd_id)
            ->where('status', 'active')
            ->count();
            
        $activeApps = Inventory::where('opd_id', $user->opd_id)
            ->where('status', 'active')
            ->count();
            
        $inactiveApps = Inventory::where('opd_id', $user->opd_id)
            ->where('status', 'inactive')
            ->count();
        
        // Platform distribution
        $webApps = Inventory::where('opd_id', $user->opd_id)
            ->where('platform', 'web')
            ->where('status', 'active')
            ->count();
            
        $mobileApps = Inventory::where('opd_id', $user->opd_id)
            ->where('platform', 'mobile')
            ->where('status', 'active')
            ->count();
            
        $desktopApps = Inventory::where('opd_id', $user->opd_id)
            ->where('platform', 'desktop')
            ->where('status', 'active')
            ->count();
        
        // Service distribution
        $serviceStats = Inventory::where('opd_id', $user->opd_id)
            ->where('status', 'active')
            ->with('layanan')
            ->get()
            ->groupBy(function($app) {
                return $app->layanan ? $app->layanan->nama_layanan : 'Tidak Ada Layanan';
            })
            ->map(function($apps) {
                return $apps->count();
            });
        
        // Prepare service stats for chart
        $serviceLabels = $serviceStats->keys()->toArray();
        $serviceData = $serviceStats->values()->toArray();
        
        // Recent applications
        $recentApps = Inventory::where('opd_id', $user->opd_id)
            ->with('category', 'statusapp')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Top applications by cost
        $topAppsByCost = Inventory::where('opd_id', $user->opd_id)
            ->where('harga', '>', 0)
            ->orderBy('harga', 'desc')
            ->take(5)
            ->get();
        
        // Applications by category
        $appsByCategory = Inventory::where('opd_id', $user->opd_id)
            ->where('status', 'active')
            ->with('category')
            ->get()
            ->groupBy('category.name')
            ->map(function($apps) {
                return $apps->count();
            });
        
        return view('opd-dashboard', [
            'opd_name' => $opdName,
            'total_apps' => $totalApps,
            'active_apps' => $activeApps,
            'inactive_apps' => $inactiveApps,
            'platform_stats' => [
                'web' => $webApps,
                'mobile' => $mobileApps,
                'desktop' => $desktopApps
            ],
            'service_stats' => [
                'labels' => $serviceLabels,
                'data' => $serviceData
            ],
            'recent_apps' => $recentApps,
            'top_apps_by_cost' => $topAppsByCost,
            'apps_by_category' => $appsByCategory
        ]);
    }

    public function costapp(): JsonResponse
    {
        $inventories = Inventory::select('name', 'harga')->orderBy('harga', 'desc')->skip(0)->take(10)->get();
        $labels = [];
        $data = [];
        foreach ($inventories as $key => $value) {
            $labels[] = $value->name;
            $data[] = $value->harga;
        }
        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Licenses',
                        'data' => $data,
                        'borderWidth' => 1,
                        'borderColor' => '#1a85f2',
                        'backgroundColor' => '#8abcee',
                    ]
                ]
            ]
        ]);
    }

    public function stsapp(): JsonResponse
    {
        $inventories = Inventory::select('status')->where('status','active')->get();
        $active = 0;
        $inactive = 0;
        foreach ($inventories as $key => $value) {
            if ($value->status == 'active') {
                $active++;
            } else {
                $inactive++;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => ['Active', 'In Active'],
                'datasets' => [
                    [
                        'data' => [$active, $inactive],
                        'borderWidth' => 1,
                        'borderColor' => ['#169dab', '#3c444b'],
                        'backgroundColor' => ['#83cdcd', '#81868a'],
                    ]
                ]
            ]
        ]);
    }

    public function opdapp(): JsonResponse
    {
        $data = Opd::select('id', 'code', 'name')->withCount(['inventory' => function ($query) {
            $query->where('status', 'active');
        }]);
        // <a href="{{ route('inventory.application.index', ['status' => 'inactive']) }}">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
        return DataTables::of($data)
            ->addColumn('inventory_count', function ($row) {
                $url = route('inventory.application.index', ['opd_id' => $row->id]);
                return '<a href="' . $url . '" > ' .$row->inventory_count .'</a>';
            })
            ->addIndexColumn()
            ->rawColumns(['inventory_count'])
            ->make(true);
    }
}
