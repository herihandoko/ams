<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'Layanan',
                'label' => 'Master Layanan',
                'url' => 'master/layanan',
                'fa_icon' => 'fa-server'
            ],
            [
                'name' => 'DataMetadata',
                'label' => 'Master Data Metadata',
                'url' => 'master/data_metadata',
                'fa_icon' => 'fa-database'
            ],
            [
                'name' => 'Unit',
                'label' => 'Master Unit',
                'url' => 'master/unit',
                'fa_icon' => 'fa-building'
            ],
            [
                'name' => 'MetadataSpbe',
                'label' => 'Master Metadata SPBE',
                'url' => 'master/metadata_spbe',
                'fa_icon' => 'fa-info-circle'
            ]
        ];

        foreach ($modules as $module) {
            $moduleId = DB::table('modules')->insertGetId($module);
            
            // Add menu for each module
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
}
