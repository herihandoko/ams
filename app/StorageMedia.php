<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageMedia extends Model
{
    use HasFactory;

    protected $table = 'storage_media';

    protected $fillable = [
        'nama_data_storage',
        'deskripsi_data_storage',
        'data_yang_digunakan_id',
        'status_kepemilikan',
        'nama_pemilik',
        'unit_pengelola_id',
        'lokasi_data_storage_id',
        'perangkat_lunak_id',
        'kapasitas_penyimpanan',
        'metode_akses_data_sharing',
        'id_metadata_terkait',
        'status'
    ];

    // Relationships
    public function dataYangDigunakan()
    {
        return $this->belongsTo(DataMetadata::class, 'data_yang_digunakan_id');
    }

    public function unitPengelola()
    {
        return $this->belongsTo(Unit::class, 'unit_pengelola_id');
    }

    public function lokasiDataStorage()
    {
        return $this->belongsTo(MetadataSpbe::class, 'lokasi_data_storage_id');
    }

    public function perangkatLunak()
    {
        return $this->belongsTo(SoftwarePlatform::class, 'perangkat_lunak_id');
    }

    public function metadataSpbe()
    {
        return $this->belongsTo(MetadataSpbe::class, 'id_metadata_terkait');
    }
}
