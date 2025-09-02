<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\SoftwarePlatform;
use App\MetadataSpbe;

class SoftwarePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get sample metadata for relationships
        $metadata = MetadataSpbe::where('status', 'aktif')->take(3)->get();

        $softwarePlatforms = [
            [
                'nama_perangkat_lunak' => 'Windows Server 2019',
                'deskripsi_perangkat_lunak' => 'Sistem operasi server dari Microsoft untuk infrastruktur enterprise',
                'tipe_perangkat_lunak' => 'sistem_operasi',
                'jenis_sistem_operasi' => 'windows',
                'jenis_sistem_utilitas' => null,
                'jenis_sistem_database' => null,
                'jenis_lisensi' => 'lisensi_periodik',
                'nama_pemilik_lisensi' => 'Microsoft Corporation',
                'validitas_lisensi' => 'Lisensi berlaku selama 3 tahun dengan opsi perpanjangan',
                'id_metadata_terkait' => $metadata->first() ? $metadata->first()->id : null,
                'status' => 'active'
            ],
            [
                'nama_perangkat_lunak' => 'MySQL Database Server',
                'deskripsi_perangkat_lunak' => 'Database management system open source yang populer',
                'tipe_perangkat_lunak' => 'sistem_database',
                'jenis_sistem_operasi' => null,
                'jenis_sistem_utilitas' => null,
                'jenis_sistem_database' => 'MySQL',
                'jenis_lisensi' => 'kode_sumber_terbuka',
                'nama_pemilik_lisensi' => 'Oracle Corporation',
                'validitas_lisensi' => 'Lisensi GPL v2 - dapat digunakan secara bebas',
                'id_metadata_terkait' => $metadata->count() > 1 ? $metadata[1]->id : null,
                'status' => 'active'
            ],
            [
                'nama_perangkat_lunak' => 'Norton Antivirus',
                'deskripsi_perangkat_lunak' => 'Software antivirus untuk proteksi sistem dari malware',
                'tipe_perangkat_lunak' => 'sistem_utilitas',
                'jenis_sistem_operasi' => null,
                'jenis_sistem_utilitas' => 'Antivirus & Security',
                'jenis_sistem_database' => null,
                'jenis_lisensi' => 'lisensi_periodik',
                'nama_pemilik_lisensi' => 'NortonLifeLock',
                'validitas_lisensi' => 'Lisensi berlaku selama 1 tahun dengan auto-renewal',
                'id_metadata_terkait' => $metadata->count() > 2 ? $metadata[2]->id : null,
                'status' => 'active'
            ],
            [
                'nama_perangkat_lunak' => 'Ubuntu Server 20.04 LTS',
                'deskripsi_perangkat_lunak' => 'Distribusi Linux server yang stabil dan aman',
                'tipe_perangkat_lunak' => 'sistem_operasi',
                'jenis_sistem_operasi' => 'unix',
                'jenis_sistem_utilitas' => null,
                'jenis_sistem_database' => null,
                'jenis_lisensi' => 'kode_sumber_terbuka',
                'nama_pemilik_lisensi' => 'Canonical Ltd',
                'validitas_lisensi' => 'Lisensi GPL - support tersedia hingga 2025',
                'id_metadata_terkait' => $metadata->first() ? $metadata->first()->id : null,
                'status' => 'active'
            ],
            [
                'nama_perangkat_lunak' => 'PostgreSQL Database',
                'deskripsi_perangkat_lunak' => 'Advanced open source database dengan fitur enterprise',
                'tipe_perangkat_lunak' => 'sistem_database',
                'jenis_sistem_operasi' => null,
                'jenis_sistem_utilitas' => null,
                'jenis_sistem_database' => 'PostgreSQL',
                'jenis_lisensi' => 'kode_sumber_terbuka',
                'nama_pemilik_lisensi' => 'PostgreSQL Global Development Group',
                'validitas_lisensi' => 'Lisensi PostgreSQL - dapat digunakan secara bebas',
                'id_metadata_terkait' => $metadata->count() > 1 ? $metadata[1]->id : null,
                'status' => 'active'
            ]
        ];

        foreach ($softwarePlatforms as $platform) {
            SoftwarePlatform::create($platform);
        }
    }
}
