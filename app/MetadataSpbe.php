<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetadataSpbe extends Model
{
    protected $table = 'metadata_spbe';
    
    protected $fillable = [
        'nama_metadata',
        'deskripsi',
        'kode_metadata',
        'kategori',
        'status'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'id_metadata_terkait');
    }
}
