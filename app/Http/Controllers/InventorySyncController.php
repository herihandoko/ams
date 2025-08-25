<?php

namespace App\Http\Controllers;

use App\Services\InventorySyncService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InventorySyncController extends Controller
{
    protected $syncService;

    public function __construct(InventorySyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Manually trigger inventory synchronization
     *
     * @return JsonResponse
     */
    public function sync()
    {
        try {
            $result = $this->syncService->syncInventoryData();
            
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Inventory synchronization completed successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Inventory synchronization failed'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during synchronization: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sync status and configuration
     *
     * @return JsonResponse
     */
    public function status()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'api_url' => env('INVENTORY_API_URL', 'https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id'),
                'auth_configured' => !empty(env('INVENTORY_API_AUTH')),
                'last_sync' => 'Check logs for last sync time'
            ]
        ]);
    }
}
