<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Servers;
use App\Unit;
use App\MetadataSpbe;
use App\SoftwarePlatform;

class UpdateServersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get sample data for relationships
        $units = Unit::where('status', 'aktif')->take(5)->get();
        $metadata = MetadataSpbe::where('status', 'aktif')->take(3)->get();
        $software = SoftwarePlatform::where('status', 'active')->take(3)->get();

        // Update existing servers with sample data
        $servers = Servers::all();
        
        foreach ($servers as $index => $server) {
            $updateData = [
                'nama_server' => 'Server ' . ($index + 1) . ' - ' . ($server->ip ?? 'Unknown IP'),
                'deskripsi_server' => 'Server dengan IP ' . ($server->ip ?? 'Unknown') . ' untuk ' . ($server->service ?? 'general purpose'),
                'jenis_penggunaan_server' => $this->getRandomJenisPenggunaan(),
                'status_kepemilikan' => $this->getRandomStatusKepemilikan(),
                'nama_pemilik' => $this->getRandomNamaPemilik(),
                'unit_pengelola_id' => $units->random()->id ?? null,
                'lokasi_fasilitas_id' => $metadata->random()->id ?? null,
                'perangkat_lunak_id' => $software->random()->id ?? null,
                'jenis_teknologi_prosesor' => $this->getRandomTeknologiProsesor(),
                'teknik_penyimpanan' => $this->getRandomTeknikPenyimpanan(),
                'id_metadata_terkait' => $metadata->random()->id ?? null,
            ];

            $server->update($updateData);
        }

        echo "Updated " . $servers->count() . " servers with sample data.\n";
    }

    private function getRandomJenisPenggunaan()
    {
        $jenis = ['web_server', 'mail_server', 'aplikasi', 'database', 'file_server', 'active_directory', 'keamanan_informasi'];
        return $jenis[array_rand($jenis)];
    }

    private function getRandomStatusKepemilikan()
    {
        $status = ['milik_sendiri', 'milik_instansi_pemerintah_lain', 'milik_bumn', 'milik_pihak_ketiga'];
        return $status[array_rand($status)];
    }

    private function getRandomNamaPemilik()
    {
        $pemilik = ['Microsoft Corporation', 'Oracle Corporation', 'Telkom Indonesia', 'BPPT', 'LIPI', 'BATAN'];
        return $pemilik[array_rand($pemilik)];
    }

    private function getRandomTeknologiProsesor()
    {
        $teknologi = ['high_end', 'mid_end', 'low_end'];
        return $teknologi[array_rand($teknologi)];
    }

    private function getRandomTeknikPenyimpanan()
    {
        $teknik = ['raid_1', 'raid_3', 'raid_5', 'non_raid'];
        return $teknik[array_rand($teknik)];
    }
}
