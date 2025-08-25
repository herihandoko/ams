<?php

namespace App\Console\Commands;

use App\Services\InventorySyncService;
use Illuminate\Console\Command;

class SyncInventoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync inventory data from external API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(InventorySyncService $syncService)
    {
        $this->info('Starting inventory synchronization...');
        
        $result = $syncService->syncInventoryData();
        
        if ($result) {
            $this->info('Inventory synchronization completed successfully!');
            return 0;
        } else {
            $this->error('Inventory synchronization failed!');
            return 1;
        }
    }
}
