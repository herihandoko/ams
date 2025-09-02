<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DataMetadata;

class DataMetadataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataMetadata = [
            [
                'nama_data' => 'Data Penduduk',
                'deskripsi' => 'Data kependudukan dan demografi',
                'kode_data' => 'DP001',
                'tipe_data' => 'Struktur',
                'status' => 'aktif'
            ],
            [
                'nama_data' => 'Data Keuangan',
                'deskripsi' => 'Data keuangan dan anggaran',
                'kode_data' => 'DK001',
                'tipe_data' => 'Transaksional',
                'status' => 'aktif'
            ],
            [
                'nama_data' => 'Data Aset',
                'deskripsi' => 'Data aset dan inventaris',
                'kode_data' => 'DA001',
                'tipe_data' => 'Master',
                'status' => 'aktif'
            ],
            [
                'nama_data' => 'Data Pegawai',
                'deskripsi' => 'Data kepegawaian dan SDM',
                'kode_data' => 'DPG001',
                'tipe_data' => 'Master',
                'status' => 'aktif'
            ]
        ];

        foreach ($dataMetadata as $data) {
            DataMetadata::create($data);
        }
    }
}
