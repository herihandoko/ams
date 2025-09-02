<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\GovernmentCloud;
use App\Unit;
use App\MetadataSpbe;

class GovernmentCloudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get sample units and metadata for relationships
        $units = Unit::where('status', 'active')->take(3)->get();
        $metadata = MetadataSpbe::where('status', 'active')->take(2)->get();

        $governmentClouds = [
            [
                'nama_government_cloud' => 'Cloud Infrastructure Pemerintah',
                'deskripsi_government_cloud' => 'Infrastructure as a Service untuk kebutuhan komputasi pemerintah',
                'tipe_government_cloud' => 'iaas',
                'status_kepemilikan' => 'milik_sendiri',
                'nama_pemilik' => null,
                'biaya_layanan' => 50000000.00,
                'unit_pengembang_id' => $units->first() ? $units->first()->id : null,
                'unit_operasional_id' => $units->first() ? $units->first()->id : null,
                'jangka_waktu_pelayanan' => '1 tahun',
                'id_metadata_terkait' => $metadata->first() ? $metadata->first()->id : null,
                'status' => 'active'
            ],
            [
                'nama_government_cloud' => 'Platform Development Cloud',
                'deskripsi_government_cloud' => 'Platform as a Service untuk pengembangan aplikasi pemerintah',
                'tipe_government_cloud' => 'paas',
                'status_kepemilikan' => 'milik_instansi_pemerintah_lain',
                'nama_pemilik' => 'BPPT',
                'biaya_layanan' => 25000000.00,
                'unit_pengembang_id' => $units->count() > 1 ? $units[1]->id : null,
                'unit_operasional_id' => $units->count() > 1 ? $units[1]->id : null,
                'jangka_waktu_pelayanan' => '6 bulan',
                'id_metadata_terkait' => $metadata->count() > 1 ? $metadata[1]->id : null,
                'status' => 'active'
            ],
            [
                'nama_government_cloud' => 'Software as a Service Cloud',
                'deskripsi_government_cloud' => 'Software as a Service untuk aplikasi perkantoran pemerintah',
                'tipe_government_cloud' => 'saas',
                'status_kepemilikan' => 'milik_bumn',
                'nama_pemilik' => 'Telkom Indonesia',
                'biaya_layanan' => 75000000.00,
                'unit_pengembang_id' => $units->count() > 2 ? $units[2]->id : null,
                'unit_operasional_id' => $units->count() > 2 ? $units[2]->id : null,
                'jangka_waktu_pelayanan' => '2 tahun',
                'id_metadata_terkait' => $metadata->first() ? $metadata->first()->id : null,
                'status' => 'active'
            ]
        ];

        foreach ($governmentClouds as $cloud) {
            GovernmentCloud::create($cloud);
        }
    }
}
