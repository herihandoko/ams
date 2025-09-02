<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    
    protected $fillable = [
        'nama_unit',
        'deskripsi',
        'kode_unit',
        'tipe_unit',
        'status'
    ];

    public function inventoriesAsPengembang()
    {
        return $this->hasMany(Inventory::class, 'unit_pengembang');
    }

    public function inventoriesAsOperasional()
    {
        return $this->hasMany(Inventory::class, 'unit_operasional_teknologi');
    }
}
