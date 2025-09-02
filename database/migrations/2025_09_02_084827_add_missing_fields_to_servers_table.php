<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            // Tambah field yang kurang dari 14 atribut
            $table->string('nama_server')->after('id')->nullable();
            $table->text('deskripsi_server')->after('nama_server')->nullable();
            $table->enum('jenis_penggunaan_server', ['web_server', 'mail_server', 'aplikasi', 'database', 'file_server', 'active_directory', 'keamanan_informasi'])->after('deskripsi_server')->nullable();
            $table->enum('status_kepemilikan', ['milik_sendiri', 'milik_instansi_pemerintah_lain', 'milik_bumn', 'milik_pihak_ketiga'])->after('jenis_penggunaan_server')->nullable();
            $table->string('nama_pemilik')->after('status_kepemilikan')->nullable();
            $table->unsignedBigInteger('unit_pengelola_id')->after('nama_pemilik')->nullable();
            $table->unsignedBigInteger('lokasi_fasilitas_id')->after('unit_pengelola_id')->nullable();
            $table->unsignedBigInteger('perangkat_lunak_id')->after('lokasi_fasilitas_id')->nullable();
            $table->enum('jenis_teknologi_prosesor', ['high_end', 'mid_end', 'low_end'])->after('perangkat_lunak_id')->nullable();
            $table->enum('teknik_penyimpanan', ['raid_1', 'raid_3', 'raid_5', 'non_raid'])->after('jenis_teknologi_prosesor')->nullable();
            $table->unsignedBigInteger('id_metadata_terkait')->after('teknik_penyimpanan')->nullable();
            
            // Tambah foreign key constraints
            $table->foreign('unit_pengelola_id')->references('id')->on('units')->onDelete('set null');
            $table->foreign('lokasi_fasilitas_id')->references('id')->on('metadata_spbe')->onDelete('set null');
            $table->foreign('perangkat_lunak_id')->references('id')->on('software_platforms')->onDelete('set null');
            $table->foreign('id_metadata_terkait')->references('id')->on('metadata_spbe')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['unit_pengelola_id']);
            $table->dropForeign(['lokasi_fasilitas_id']);
            $table->dropForeign(['perangkat_lunak_id']);
            $table->dropForeign(['id_metadata_terkait']);
            
            // Drop columns
            $table->dropColumn([
                'nama_server',
                'deskripsi_server',
                'jenis_penggunaan_server',
                'status_kepemilikan',
                'nama_pemilik',
                'unit_pengelola_id',
                'lokasi_fasilitas_id',
                'perangkat_lunak_id',
                'jenis_teknologi_prosesor',
                'teknik_penyimpanan',
                'id_metadata_terkait'
            ]);
        });
    }
}
