<?php

require_once 'vendor/autoload.php';

use App\Inventory;
use Illuminate\Support\Facades\Http;

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALISIS PERBEDAAN STATUS ACTIVE ===\n\n";

// Fetch API data
$apiUrl = 'https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id';
$authHeader = 'Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw==';

try {
    $response = Http::withHeaders([
        'Authorization' => $authHeader
    ])->get($apiUrl);

    if ($response->successful()) {
        $data = $response->json();
        
        if (isset($data['status']) && $data['status'] === true) {
            $apiData = $data['data'] ?? [];
            
            // Get active domains from API
            $apiActiveDomains = collect($apiData)
                ->where('Status', 'Active')
                ->pluck('Domain')
                ->toArray();
            
            // Get active domains from database
            $dbActiveDomains = Inventory::where('status', 'active')
                ->pluck('url')
                ->toArray();
            
            echo "📊 STATISTIK ACTIVE:\n";
            echo "API Active: " . count($apiActiveDomains) . "\n";
            echo "DB Active: " . count($dbActiveDomains) . "\n";
            echo "Perbedaan: " . (count($apiActiveDomains) - count($dbActiveDomains)) . "\n\n";
            
            // Find active domains in API but not in DB
            $activeInApiNotDb = array_diff($apiActiveDomains, $dbActiveDomains);
            echo "❌ ACTIVE DI API TAPI TIDAK DI DATABASE (" . count($activeInApiNotDb) . "):\n";
            foreach ($activeInApiNotDb as $domain) {
                echo "- $domain\n";
            }
            echo "\n";
            
            // Find active domains in DB but not in API
            $activeInDbNotApi = array_diff($dbActiveDomains, $apiActiveDomains);
            echo "❌ ACTIVE DI DATABASE TAPI TIDAK DI API (" . count($activeInDbNotApi) . "):\n";
            foreach ($activeInDbNotApi as $domain) {
                echo "- $domain\n";
            }
            echo "\n";
            
            // Check inactive domains that should be active
            $inactiveInDbButActiveInApi = [];
            foreach ($apiActiveDomains as $apiDomain) {
                $dbRecord = Inventory::where('url', $apiDomain)->first();
                if ($dbRecord && $dbRecord->status !== 'active') {
                    $inactiveInDbButActiveInApi[] = $apiDomain;
                }
            }
            
            echo "⚠️ DOMAIN ACTIVE DI API TAPI INACTIVE DI DATABASE (" . count($inactiveInDbButActiveInApi) . "):\n";
            foreach ($inactiveInDbButActiveInApi as $domain) {
                echo "- $domain\n";
            }
            
        } else {
            echo "❌ API response tidak valid\n";
        }
    } else {
        echo "❌ Gagal fetch API data\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== ANALISIS SELESAI ===\n";
