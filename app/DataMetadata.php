<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMetadata extends Model
{
    protected $table = 'data_metadata';
    
    protected $fillable = [
        'nama_data',
        'deskripsi',
        'kode_data',
        'tipe_data',
        'status'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'id_data');
    }
}
