<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_media', function (Blueprint $table) {
            $table->id();
            $table->string('nama_data_storage');
            $table->text('deskripsi_data_storage')->nullable();
            $table->unsignedBigInteger('data_yang_digunakan_id')->nullable();
            $table->enum('status_kepemilikan', ['milik_sendiri', 'milik_instansi_pemerintah_lain', 'milik_bumn', 'milik_pihak_ketiga']);
            $table->string('nama_pemilik')->nullable();
            $table->unsignedBigInteger('unit_pengelola_id')->nullable();
            $table->unsignedBigInteger('lokasi_data_storage_id')->nullable();
            $table->unsignedBigInteger('perangkat_lunak_id')->nullable();
            $table->integer('kapasitas_penyimpanan')->comment('dalam GB');
            $table->enum('metode_akses_data_sharing', ['das', 'nas']);
            $table->unsignedBigInteger('id_metadata_terkait')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->foreign('data_yang_digunakan_id')->references('id')->on('data_metadata')->onDelete('set null');
            $table->foreign('unit_pengelola_id')->references('id')->on('units')->onDelete('set null');
            $table->foreign('lokasi_data_storage_id')->references('id')->on('metadata_spbe')->onDelete('set null');
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
        Schema::dropIfExists('storage_media');
    }
}
