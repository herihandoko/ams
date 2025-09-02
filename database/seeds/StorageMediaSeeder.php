<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\StorageMedia;
use App\DataMetadata;
use App\Unit;
use App\MetadataSpbe;
use App\SoftwarePlatform;

class StorageMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get sample data for relationships
        $dataMetadata = DataMetadata::where('status', 'aktif')->take(3)->get();
        $units = Unit::where('status', 'aktif')->take(3)->get();
        $metadataSpbe = MetadataSpbe::where('status', 'aktif')->take(3)->get();
        $softwarePlatforms = SoftwarePlatform::where('status', 'active')->take(3)->get();

        // Sample storage media data
        $storageMediaData = [
            [
                'nama_data_storage' => 'Storage Server Primary',
                'deskripsi_data_storage' => 'Storage server utama untuk menyimpan data aplikasi dan database',
                'data_yang_digunakan_id' => $dataMetadata->first()?->id,
                'status_kepemilikan' => 'milik_sendiri',
                'nama_pemilik' => null,
                'unit_pengelola_id' => $units->first()?->id,
                'lokasi_data_storage_id' => $metadataSpbe->first()?->id,
                'perangkat_lunak_id' => $softwarePlatforms->first()?->id,
                'kapasitas_penyimpanan' => 2048,
                'metode_akses_data_sharing' => 'nas',
                'id_metadata_terkait' => $metadataSpbe->first()?->id,
                'status' => 'active'
            ],
            [
                'nama_data_storage' => 'Backup Storage NAS',
                'deskripsi_data_storage' => 'Storage untuk backup data dan disaster recovery',
                'data_yang_digunakan_id' => $dataMetadata->get(1)?->id,
                'status_kepemilikan' => 'milik_instansi_pemerintah_lain',
                'nama_pemilik' => 'BPPT',
                'unit_pengelola_id' => $units->get(1)?->id,
                'lokasi_data_storage_id' => $metadataSpbe->get(1)?->id,
                'perangkat_lunak_id' => $softwarePlatforms->get(1)?->id,
                'kapasitas_penyimpanan' => 1024,
                'metode_akses_data_sharing' => 'nas',
                'id_metadata_terkait' => $metadataSpbe->get(1)?->id,
                'status' => 'active'
            ],
            [
                'nama_data_storage' => 'Local Storage DAS',
                'deskripsi_data_storage' => 'Storage lokal untuk aplikasi yang membutuhkan akses cepat',
                'data_yang_digunakan_id' => $dataMetadata->get(2)?->id,
                'status_kepemilikan' => 'milik_bumn',
                'nama_pemilik' => 'Telkom Indonesia',
                'unit_pengelola_id' => $units->get(2)?->id,
                'lokasi_data_storage_id' => $metadataSpbe->get(2)?->id,
                'perangkat_lunak_id' => $softwarePlatforms->get(2)?->id,
                'kapasitas_penyimpanan' => 512,
                'metode_akses_data_sharing' => 'das',
                'id_metadata_terkait' => $metadataSpbe->get(2)?->id,
                'status' => 'active'
            ],
            [
                'nama_data_storage' => 'Cloud Storage Hybrid',
                'deskripsi_data_storage' => 'Storage hybrid untuk integrasi cloud dan on-premise',
                'data_yang_digunakan_id' => $dataMetadata->first()?->id,
                'status_kepemilikan' => 'milik_pihak_ketiga',
                'nama_pemilik' => 'Microsoft Azure',
                'unit_pengelola_id' => $units->first()?->id,
                'lokasi_data_storage_id' => $metadataSpbe->first()?->id,
                'perangkat_lunak_id' => $softwarePlatforms->first()?->id,
                'kapasitas_penyimpanan' => 4096,
                'metode_akses_data_sharing' => 'nas',
                'id_metadata_terkait' => $metadataSpbe->first()?->id,
                'status' => 'active'
            ],
            [
                'nama_data_storage' => 'Archive Storage',
                'deskripsi_data_storage' => 'Storage untuk arsip data lama dan compliance',
                'data_yang_digunakan_id' => $dataMetadata->get(1)?->id,
                'status_kepemilikan' => 'milik_sendiri',
                'nama_pemilik' => null,
                'unit_pengelola_id' => $units->get(1)?->id,
                'lokasi_data_storage_id' => $metadataSpbe->get(1)?->id,
                'perangkat_lunak_id' => $softwarePlatforms->get(1)?->id,
                'kapasitas_penyimpanan' => 8192,
                'metode_akses_data_sharing' => 'nas',
                'id_metadata_terkait' => $metadataSpbe->get(1)?->id,
                'status' => 'active'
            ]
        ];

        foreach ($storageMediaData as $data) {
            StorageMedia::create($data);
        }

        echo "Storage Media seeded successfully!\n";
    }
}
