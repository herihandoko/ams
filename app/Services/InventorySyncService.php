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

    protected function processApiRecords($apiData)
    {
        foreach ($apiData as $apiRecord) {
            $domain = $apiRecord['Domain'] ?? '';
            $ipAddress = $apiRecord['IpAddress'] ?? '';
            $status = $apiRecord['Status'] ?? '';
            
            // Find inventory records by IP address (through server relationship)
            $inventories = $this->findInventoriesByIp($ipAddress);
            
            foreach ($inventories as $inventory) {
                $this->updateInventoryRecord($inventory, $apiRecord);
            }
            
            // Also check by domain in URL field
            $inventoriesByDomain = $this->findInventoriesByDomain($domain);
            
            foreach ($inventoriesByDomain as $inventory) {
                $this->updateInventoryRecord($inventory, $apiRecord);
            }
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
        return Inventory::where('url', 'like', '%' . $domain . '%')->get();
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
            $inventory->update($updates);
            Log::info("Updated inventory ID {$inventory->id} with changes: " . json_encode($updates));
        }
    }

    protected function markMissingRecordsAsInactive($apiData)
    {
        // Get all IP addresses from API
        $apiIps = collect($apiData)->pluck('IpAddress')->filter()->toArray();
        $apiDomains = collect($apiData)->pluck('Domain')->filter()->toArray();
        
        // Find inventories that are not in the API data
        $inventoriesToDeactivate = Inventory::where(function ($query) use ($apiIps, $apiDomains) {
            $query->whereHas('server', function ($serverQuery) use ($apiIps) {
                $serverQuery->whereNotIn('ip', $apiIps);
            })->orWhere(function ($urlQuery) use ($apiDomains) {
                foreach ($apiDomains as $domain) {
                    $urlQuery->where('url', 'not like', '%' . $domain . '%');
                }
            });
        })->where('status', '!=', 'Inactive')->get();
        
        foreach ($inventoriesToDeactivate as $inventory) {
            $inventory->update(['status' => strtolower('Inactive')]);
            Log::info("Marked inventory ID {$inventory->id} as inactive (not found in API)");
        }
    }
}
