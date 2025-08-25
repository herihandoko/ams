<?php

require_once 'vendor/autoload.php';

use App\Inventory;

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALISIS SYNC SOURCE ===\n\n";

// Get statistics by sync_source
$apiRecords = Inventory::where('sync_source', 'api')->count();
$localRecords = Inventory::where('sync_source', 'local')->count();
$nullRecords = Inventory::whereNull('sync_source')->count();

echo "📊 STATISTIK SYNC SOURCE:\n";
echo "API Records: {$apiRecords}\n";
echo "Local Records: {$localRecords}\n";
echo "Null Records: {$nullRecords}\n";
echo "Total Records: " . Inventory::count() . "\n\n";

// Show active records by source
$apiActive = Inventory::where('sync_source', 'api')->where('status', 'active')->count();
$localActive = Inventory::where('sync_source', 'local')->where('status', 'active')->count();

echo "🟢 ACTIVE RECORDS BY SOURCE:\n";
echo "API Active: {$apiActive}\n";
echo "Local Active: {$localActive}\n\n";

// Show local records (not in API)
echo "🏠 LOCAL RECORDS (not in API):\n";
$localRecordsList = Inventory::where('sync_source', 'local')->get();
foreach ($localRecordsList as $record) {
    echo "- ID: {$record->id}, URL: {$record->url}, Status: {$record->status}\n";
}
echo "\n";

// Show recently synced records
echo "🕒 RECENTLY SYNCED RECORDS (last 10):\n";
$recentRecords = Inventory::whereNotNull('last_sync_at')
    ->orderBy('last_sync_at', 'desc')
    ->limit(10)
    ->get();

foreach ($recentRecords as $record) {
    $syncTime = $record->last_sync_at ?? 'N/A';
    echo "- ID: {$record->id}, URL: {$record->url}, Source: {$record->sync_source}, Sync: {$syncTime}\n";
}

echo "\n=== ANALISIS SELESAI ===\n";
