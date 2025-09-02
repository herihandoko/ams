<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = [
            [
                'nama_unit' => 'Unit Pengembangan Aplikasi',
                'deskripsi' => 'Unit yang bertanggung jawab atas pengembangan aplikasi',
                'kode_unit' => 'UPA001',
                'tipe_unit' => 'pengembang',
                'status' => 'aktif'
            ],
            [
                'nama_unit' => 'Unit Operasional IT',
                'deskripsi' => 'Unit yang bertanggung jawab atas operasional IT',
                'kode_unit' => 'UOI001',
                'tipe_unit' => 'operasional',
                'status' => 'aktif'
            ],
            [
                'nama_unit' => 'Unit IT Terpadu',
                'deskripsi' => 'Unit yang mengelola pengembangan dan operasional IT',
                'kode_unit' => 'UIT001',
                'tipe_unit' => 'keduanya',
                'status' => 'aktif'
            ],
            [
                'nama_unit' => 'Unit Infrastruktur',
                'deskripsi' => 'Unit yang mengelola infrastruktur IT',
                'kode_unit' => 'UI001',
                'tipe_unit' => 'operasional',
                'status' => 'aktif'
            ]
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
