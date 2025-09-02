<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwarePlatform extends Model
{
    use HasFactory;

    protected $table = 'software_platforms';

    protected $fillable = [
        'nama_perangkat_lunak',
        'deskripsi_perangkat_lunak',
        'tipe_perangkat_lunak',
        'jenis_sistem_operasi',
        'jenis_sistem_utilitas',
        'jenis_sistem_database',
        'jenis_lisensi',
        'nama_pemilik_lisensi',
        'validitas_lisensi',
        'id_metadata_terkait',
        'status'
    ];

    // Relationships
    public function metadataSpbe()
    {
        return $this->belongsTo(MetadataSpbe::class, 'id_metadata_terkait');
    }
}
