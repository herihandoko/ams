<?php

require_once 'vendor/autoload.php';

use App\Inventory;
use App\Servers;
use Illuminate\Support\Facades\Http;

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALISIS PERBEDAAN DATA API vs DATABASE ===\n\n";

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
            
            echo "📊 STATISTIK:\n";
            echo "API Total Records: " . count($apiData) . "\n";
            echo "Database Total Records: " . Inventory::count() . "\n";
            echo "Perbedaan: " . (count($apiData) - Inventory::count()) . " records\n\n";
            
            // Get all domains from database
            $dbDomains = Inventory::pluck('url')->toArray();
            $apiDomains = collect($apiData)->pluck('Domain')->toArray();
            
            echo "🔍 ANALISIS DOMAIN:\n";
            echo "API Domains: " . count($apiDomains) . "\n";
            echo "DB Domains: " . count($dbDomains) . "\n\n";
            
            // Find domains in API but not in DB
            $missingInDB = array_diff($apiDomains, $dbDomains);
            echo "❌ DOMAINS DI API TAPI TIDAK DI DATABASE (" . count($missingInDB) . "):\n";
            foreach (array_slice($missingInDB, 0, 10) as $domain) {
                echo "- $domain\n";
            }
            if (count($missingInDB) > 10) {
                echo "... dan " . (count($missingInDB) - 10) . " domain lainnya\n";
            }
            echo "\n";
            
            // Find domains in DB but not in API
            $missingInAPI = array_diff($dbDomains, $apiDomains);
            echo "❌ DOMAINS DI DATABASE TAPI TIDAK DI API (" . count($missingInAPI) . "):\n";
            foreach (array_slice($missingInAPI, 0, 10) as $domain) {
                echo "- $domain\n";
            }
            if (count($missingInAPI) > 10) {
                echo "... dan " . (count($missingInAPI) - 10) . " domain lainnya\n";
            }
            echo "\n";
            
            // Check by IP addresses
            echo "🌐 ANALISIS IP ADDRESS:\n";
            $apiIps = collect($apiData)->pluck('IpAddress')->filter()->toArray();
            $dbIps = Servers::pluck('ip')->toArray();
            
            echo "API IPs: " . count($apiIps) . "\n";
            echo "DB IPs: " . count($dbIps) . "\n";
            
            $missingIPsInDB = array_diff($apiIps, $dbIps);
            echo "❌ IPs DI API TAPI TIDAK DI DATABASE (" . count($missingIPsInDB) . "):\n";
            foreach (array_slice($missingIPsInDB, 0, 5) as $ip) {
                echo "- $ip\n";
            }
            if (count($missingIPsInDB) > 5) {
                echo "... dan " . (count($missingIPsInDB) - 5) . " IP lainnya\n";
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
