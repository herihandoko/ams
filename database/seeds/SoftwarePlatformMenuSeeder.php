<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoftwarePlatformMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create module for Software Platform
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'Software Platform',
            'label' => 'Master Metadata Perangkat Lunak Platform',
            'url' => 'master/software_platform',
            'fa_icon' => 'fa-desktop',
            'code' => 'software-platform'
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
