<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentCloud extends Model
{
    use HasFactory;

    protected $table = 'government_clouds';

    protected $fillable = [
        'nama_government_cloud',
        'deskripsi_government_cloud',
        'tipe_government_cloud',
        'status_kepemilikan',
        'nama_pemilik',
        'biaya_layanan',
        'unit_pengembang_id',
        'unit_operasional_id',
        'jangka_waktu_pelayanan',
        'id_metadata_terkait',
        'status'
    ];

    protected $casts = [
        'biaya_layanan' => 'decimal:2'
    ];

    // Relationships
    public function unitPengembang()
    {
        return $this->belongsTo(Unit::class, 'unit_pengembang_id');
    }

    public function unitOperasional()
    {
        return $this->belongsTo(Unit::class, 'unit_operasional_id');
    }

    public function metadataSpbe()
    {
        return $this->belongsTo(MetadataSpbe::class, 'id_metadata_terkait');
    }
}
