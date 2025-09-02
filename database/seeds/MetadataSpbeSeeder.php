<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\MetadataSpbe;

class MetadataSpbeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metadataSpbe = [
            [
                'nama_metadata' => 'Metadata Aplikasi',
                'deskripsi' => 'Metadata untuk aplikasi dan sistem',
                'kode_metadata' => 'MAP001',
                'kategori' => 'Aplikasi',
                'status' => 'aktif'
            ],
            [
                'nama_metadata' => 'Metadata Layanan',
                'deskripsi' => 'Metadata untuk layanan publik',
                'kode_metadata' => 'ML001',
                'kategori' => 'Layanan',
                'status' => 'aktif'
            ],
            [
                'nama_metadata' => 'Metadata Data',
                'deskripsi' => 'Metadata untuk data dan informasi',
                'kode_metadata' => 'MD001',
                'kategori' => 'Data',
                'status' => 'aktif'
            ],
            [
                'nama_metadata' => 'Metadata Infrastruktur',
                'deskripsi' => 'Metadata untuk infrastruktur IT',
                'kode_metadata' => 'MI001',
                'kategori' => 'Infrastruktur',
                'status' => 'aktif'
            ]
        ];

        foreach ($metadataSpbe as $metadata) {
            MetadataSpbe::create($metadata);
        }
    }
}
