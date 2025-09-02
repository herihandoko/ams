<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';
    
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'kode_layanan',
        'status'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'id_layanan');
    }
}
