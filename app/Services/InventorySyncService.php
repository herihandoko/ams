<?php

namespace App\Services;

use App\Inventory;
use App\Servers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InventorySyncService
{
    protected $apiUrl;
    protected $authHeader;

    public function __construct()
    {
        $this->apiUrl = env('INVENTORY_API_URL', 'https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id');
        $this->authHeader = env('INVENTORY_API_AUTH', 'Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw==');
    }

    public function syncInventoryData()
    {
        try {
            Log::info('Starting inventory sync process');
            
            // Fetch data from external API
            $apiData = $this->fetchApiData();
            
            if (!$apiData) {
                Log::error('Failed to fetch data from API');
                return false;
            }

            // Process each record from API
            $this->processApiRecords($apiData);
            
            // Mark records not in API as inactive
            $this->markMissingRecordsAsInactive($apiData);
            
            Log::info('Inventory sync process completed successfully');
            return true;
            
        } catch (\Exception $e) {
            Log::error('Error during inventory sync: ' . $e->getMessage());
            return false;
        }
    }

    protected function fetchApiData()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->authHeader
            ])->get($this->apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === true) {
                    return $data['data'] ?? [];
                }
            }
            
            Log::error('API response error: ' . $response->body());
            return null;
            
        } catch (\Exception $e) {
            Log::error('Error fetching API data: ' . $e->getMessage());
            return null;
        }
    }



    protected function findInventoriesByIp($ipAddress)
    {
        return Inventory::whereHas('server', function ($query) use ($ipAddress) {
            $query->where('ip', $ipAddress);
        })->get();
    }

    protected function findInventoriesByDomain($domain)
    {
        // Use exact match instead of LIKE to avoid false positives
        return Inventory::where('url', $domain)->get();
    }

    protected function updateInventoryRecord($inventory, $apiRecord)
    {
        $domain = $apiRecord['Domain'] ?? '';
        $status = $apiRecord['Status'] ?? '';
        
        $updates = [];
        
        // Update status based on API status
        if ($status === 'Deactive') {
            $updates['status'] = strtolower('Inactive');
        } elseif ($status === 'Active') {
            $updates['status'] = strtolower('Active');
        }
        
        // Update URL if it doesn't match the domain
        if (!empty($domain) && !str_contains($inventory->url, $domain)) {
            $updates['url'] = $domain;
        }
        
        if (!empty($updates)) {
            // Add sync metadata
            $updates['sync_source'] = 'api';
            $updates['last_sync_at'] = now();
            
            $inventory->update($updates);
            Log::info("Updated inventory ID {$inventory->id} with changes: " . json_encode($updates));
        }
    }

    protected function processApiRecords($apiData)
    {
        $processedCount = 0;
        $createdCount = 0;
        $updatedCount = 0;
        
        // Group API records by domain to handle multiple records per domain
        $groupedApiData = collect($apiData)->groupBy('Domain');
        
        foreach ($groupedApiData as $domain => $apiRecords) {
            $processedCount++;
            
            // Check by domain in URL field first (exact match)
            $inventoriesByDomain = $this->findInventoriesByDomain($domain);
            
            if ($inventoriesByDomain->isNotEmpty()) {
                // Update existing records - only update the first one to avoid duplicates
                $inventory = $inventoriesByDomain->first();
                // Find the best matching API record (prioritize Active status)
                $bestApiRecord = $this->findBestMatchingApiRecord($apiRecords, $inventory);
                $this->updateInventoryRecord($inventory, $bestApiRecord);
                $updatedCount++;
                
                // Delete duplicate records if any
                $duplicates = $inventoriesByDomain->slice(1);
                foreach ($duplicates as $duplicate) {
                    $duplicate->delete();
                    Log::info("Deleted duplicate inventory record ID {$duplicate->id} for domain: {$domain}");
                }
                
                Log::info("Found existing records for domain: {$domain}. Updated first record, deleted " . $duplicates->count() . " duplicates.");
            } else {
                // Create new record
                Log::info("No exact domain match found for domain: {$domain}. Creating new record...");
                $this->createNewInventoryRecord($apiRecords->first());
                $createdCount++;
            }
        }
        
        Log::info("Sync summary: Processed {$processedCount} API domains, Created {$createdCount} new records, Updated {$updatedCount} existing records");
    }

    protected function findBestMatchingApiRecord($apiRecords, $inventory)
    {
        // Prioritize Active status
        $activeRecord = $apiRecords->where('Status', 'Active')->first();
        if ($activeRecord) {
            return $activeRecord;
        }
        
        // If no active record, return the first one
        return $apiRecords->first();
    }

    protected function markMissingRecordsAsInactive($apiData)
    {
        // Get all domains from API
        $apiDomains = collect($apiData)->pluck('Domain')->filter()->toArray();
        
        // Find active inventories that are not in the API data
        $inventoriesToDeactivate = Inventory::where('status', 'active')
            ->whereNotIn('url', $apiDomains)
            ->get();
        
        foreach ($inventoriesToDeactivate as $inventory) {
            $inventory->update([
                'status' => 'inactive',
                'sync_source' => 'local',
                'last_sync_at' => now()
            ]);
            Log::info("Marked inventory ID {$inventory->id} ({$inventory->url}) as inactive (not found in API) - marked as local");
        }
        
        Log::info("Marked " . $inventoriesToDeactivate->count() . " active records as inactive (not found in API)");
    }

    protected function createNewInventoryRecord($apiRecord)
    {
        $domain = $apiRecord['Domain'] ?? '';
        $ipAddress = $apiRecord['IpAddress'] ?? '';
        $status = $apiRecord['Status'] ?? '';
        
        Log::info("Attempting to create new inventory record for domain: {$domain}, IP: {$ipAddress}");
        
        try {
            // First, check if server exists with this IP, if not create it
            $server = $this->findOrCreateServer($ipAddress);
            Log::info("Server found/created: ID {$server->id} for IP {$ipAddress}");
            
            // Create new inventory record
            $inventory = Inventory::create([
                'code' => 'API_' . str_replace('.', '_', $domain),
                'name' => $domain,
                'version' => '1.0',
                'user_base' => 'N/A',
                'scope' => 'external',
                'keterangan' => 'Auto-created from API sync',
                'opd_id' => '1', // Default OPD ID
                'category_id' => 1, // Default category ID
                'url' => $domain,
                'tahun_anggaran' => date('Y'),
                'created_by' => 1, // Default user ID
                'updated_by' => 1, // Default user ID
                'status' => $status === 'Active' ? 'active' : 'inactive',
                'platform' => 'web',
                'manufacturer' => 'N/A',
                'server_id' => $server->id,
                'type_hosting' => 'external',
                'predecessor_app' => 0,
                'sub_unit' => '1',
                'sync_source' => 'api',
                'last_sync_at' => now()
            ]);
            
            Log::info("Successfully created new inventory record ID {$inventory->id} for domain: {$domain}");
            
        } catch (\Exception $e) {
            Log::error("Failed to create inventory record for domain {$domain}: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
        }
    }

    protected function findOrCreateServer($ipAddress)
    {
        $server = Servers::where('ip', $ipAddress)->first();
        
        if (!$server) {
            $server = Servers::create([
                'ip' => $ipAddress,
                'type' => 'web',
                'hdd' => 'N/A',
                'ram' => 'N/A',
                'cpu' => 'N/A',
                'service' => 'N/A'
            ]);
            
            Log::info("Created new server record ID {$server->id} for IP: {$ipAddress}");
        }
        
        return $server;
    }
}
