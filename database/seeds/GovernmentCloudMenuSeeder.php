<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernmentCloudMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create module for Government Cloud
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'Government Cloud',
            'label' => 'Master Metadata Komputasi Awan',
            'url' => 'master/government_cloud',
            'fa_icon' => 'fa-cloud',
            'code' => 'government-cloud'
        ]);
        
        // Add menu for the module
        DB::table('menus')->insert([
            'module_id' => $moduleId,
            'parent' => 0,
            'hierarchy' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // Add role module access (assuming role_id 1 has admin access)
        DB::table('role_module')->insert([
            'role_id' => 1,
            'module_id' => $moduleId,
            'acc_view' => 1,
            'acc_create' => 1,
            'acc_edit' => 1,
            'acc_delete' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
