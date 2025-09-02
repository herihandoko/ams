<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layanans = [
            [
                'nama_layanan' => 'Layanan Publik',
                'deskripsi' => 'Layanan yang disediakan untuk masyarakat umum',
                'kode_layanan' => 'LP001',
                'status' => 'aktif'
            ],
            [
                'nama_layanan' => 'Tata Kelola Pemerintah',
                'deskripsi' => 'Layanan internal untuk tata kelola pemerintahan',
                'kode_layanan' => 'TKP001',
                'status' => 'aktif'
            ],
            [
                'nama_layanan' => 'Layanan Administrasi',
                'deskripsi' => 'Layanan administrasi dan pelaporan',
                'kode_layanan' => 'LA001',
                'status' => 'aktif'
            ],
            [
                'nama_layanan' => 'Layanan Keuangan',
                'deskripsi' => 'Layanan terkait keuangan dan anggaran',
                'kode_layanan' => 'LK001',
                'status' => 'aktif'
            ]
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
