<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwarePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perangkat_lunak');
            $table->text('deskripsi_perangkat_lunak')->nullable();
            $table->enum('tipe_perangkat_lunak', ['sistem_operasi', 'sistem_utilitas', 'sistem_database']);
            $table->enum('jenis_sistem_operasi', ['dos', 'unix', 'macos', 'windows', 'networking_os', 'lainnya'])->nullable();
            $table->string('jenis_sistem_utilitas')->nullable();
            $table->string('jenis_sistem_database')->nullable();
            $table->enum('jenis_lisensi', ['lisensi_seumur_hidup', 'lisensi_periodik', 'kode_sumber_terbuka']);
            $table->string('nama_pemilik_lisensi')->nullable();
            $table->text('validitas_lisensi')->nullable();
            $table->unsignedBigInteger('id_metadata_terkait')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

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
        Schema::dropIfExists('software_platforms');
    }
}
