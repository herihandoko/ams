<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentCloudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_clouds', function (Blueprint $table) {
            $table->id();
            $table->string('nama_government_cloud');
            $table->text('deskripsi_government_cloud')->nullable();
            $table->enum('tipe_government_cloud', ['paas', 'iaas', 'saas', 'bdaas', 'secaas']);
            $table->enum('status_kepemilikan', ['milik_sendiri', 'milik_instansi_pemerintah_lain', 'milik_bumn', 'milik_pihak_ketiga']);
            $table->string('nama_pemilik')->nullable();
            $table->decimal('biaya_layanan', 15, 2)->nullable();
            $table->unsignedBigInteger('unit_pengembang_id')->nullable();
            $table->unsignedBigInteger('unit_operasional_id')->nullable();
            $table->string('jangka_waktu_pelayanan')->nullable();
            $table->unsignedBigInteger('id_metadata_terkait')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('unit_pengembang_id')->references('id')->on('units')->onDelete('set null');
            $table->foreign('unit_operasional_id')->references('id')->on('units')->onDelete('set null');
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
        Schema::dropIfExists('government_clouds');
    }
}
