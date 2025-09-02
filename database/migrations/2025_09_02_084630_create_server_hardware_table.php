<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerHardwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_hardware', function (Blueprint $table) {
            $table->id();
            $table->string('nama_server');
            $table->text('deskripsi_server')->nullable();
            $table->enum('jenis_penggunaan_server', ['web_server', 'mail_server', 'aplikasi', 'database', 'file_server', 'active_directory', 'keamanan_informasi']);
            $table->enum('status_kepemilikan', ['milik_sendiri', 'milik_instansi_pemerintah_lain', 'milik_bumn', 'milik_pihak_ketiga']);
            $table->string('nama_pemilik')->nullable();
            $table->unsignedBigInteger('unit_pengelola_id')->nullable();
            $table->unsignedBigInteger('lokasi_fasilitas_id')->nullable();
            $table->unsignedBigInteger('perangkat_lunak_id')->nullable();
            $table->integer('kapasitas_memori')->comment('dalam GB');
            $table->enum('jenis_teknologi_prosesor', ['high_end', 'mid_end', 'low_end']);
            $table->integer('kapasitas_penyimpanan')->comment('dalam GB');
            $table->enum('teknik_penyimpanan', ['raid_1', 'raid_3', 'raid_5', 'non_raid']);
            $table->unsignedBigInteger('id_metadata_terkait')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

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
        Schema::dropIfExists('server_hardware');
    }
}
