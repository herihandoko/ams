<?php

require_once 'vendor/autoload.php';

use App\Inventory;
use App\Servers;
use Illuminate\Support\Facades\Http;

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST LOGIC MATCHING ===\n\n";

// Test specific domains that should not exist
$testDomains = [
    'demo.bantenprov.go.id',
    'linux.dev.bantenprov.go.id',
    'dataset.dev.bantenprov.go.id',
    'dev2019.bantenprov.go.id',
    'dev.bantenprov.go.id'
];

foreach ($testDomains as $domain) {
    echo "Testing domain: $domain\n";
    
    // Check by domain in URL field
    $inventoriesByDomain = Inventory::where('url', 'like', '%' . $domain . '%')->get();
    echo "  - Found by domain matching: " . $inventoriesByDomain->count() . " records\n";
    
    // Check by exact domain
    $exactMatch = Inventory::where('url', $domain)->get();
    echo "  - Found by exact match: " . $exactMatch->count() . " records\n";
    
    if ($inventoriesByDomain->count() > 0) {
        echo "  - Matching records:\n";
        foreach ($inventoriesByDomain as $inv) {
            echo "    * ID: {$inv->id}, URL: {$inv->url}\n";
        }
    }
    echo "\n";
}

echo "=== TEST SELESAI ===\n";
