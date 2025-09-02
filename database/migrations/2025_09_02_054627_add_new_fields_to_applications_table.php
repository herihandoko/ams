<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Metadata SPBE
            $table->string('refferensi_code')->nullable()->after('keterangan');
            $table->unsignedBigInteger('id_layanan')->nullable()->after('refferensi_code');
            $table->unsignedBigInteger('id_data')->nullable()->after('id_layanan');
            $table->text('luaran')->nullable()->after('id_data');
            
            // Data Flow
            $table->text('inputan_data')->nullable()->after('luaran');
            $table->string('supplier_data')->nullable()->after('inputan_data');
            $table->text('luaran_data')->nullable()->after('supplier_data');
            $table->string('customer_data')->nullable()->after('luaran_data');
            
            // Teknis Lanjutan
            $table->enum('basis_aplikasi', ['desktop', 'web', 'cloud', 'mobile'])->nullable()->after('customer_data');
            $table->unsignedBigInteger('server_aplikasi')->nullable()->after('basis_aplikasi');
            $table->enum('tipe_lisensi', ['open_source', 'proprietary'])->nullable()->after('server_aplikasi');
            $table->string('kerangka_pengembangan')->nullable()->after('tipe_lisensi');
            
            // Organisasi
            $table->unsignedBigInteger('unit_pengembang')->nullable()->after('kerangka_pengembangan');
            $table->unsignedBigInteger('unit_operasional_teknologi')->nullable()->after('unit_pengembang');
            $table->unsignedBigInteger('id_metadata_terkait')->nullable()->after('unit_operasional_teknologi');
            
            // Foreign keys
            $table->foreign('id_layanan')->references('id')->on('layanans')->onDelete('set null');
            $table->foreign('id_data')->references('id')->on('data_metadata')->onDelete('set null');
            $table->foreign('server_aplikasi')->references('id')->on('servers')->onDelete('set null');
            $table->foreign('unit_pengembang')->references('id')->on('units')->onDelete('set null');
            $table->foreign('unit_operasional_teknologi')->references('id')->on('units')->onDelete('set null');
            $table->foreign('id_metadata_terkait')->references('id')->on('metadata_spbe')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['id_layanan', 'id_data', 'server_aplikasi', 'unit_pengembang', 'unit_operasional_teknologi', 'id_metadata_terkait']);
            $table->dropColumn([
                'refferensi_code', 'id_layanan', 'id_data', 'luaran',
                'inputan_data', 'supplier_data', 'luaran_data', 'customer_data',
                'basis_aplikasi', 'server_aplikasi', 'tipe_lisensi', 'kerangka_pengembangan',
                'unit_pengembang', 'unit_operasional_teknologi', 'id_metadata_terkait'
            ]);
        });
    }
};
