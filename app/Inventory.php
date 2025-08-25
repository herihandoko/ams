<?php

namespace App;

use App\Model\Category;
use App\Model\StatusAplikasi;
use App\Servers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'version',
        'user_base',
        'scope',
        'keterangan',
        'opd_id',
        'category_id',
        'url',
        'tahun_anggaran',
        'created_by',
        'updated_by',
        'status',
        'platform',
        'manufacturer',
        'server_id',
        'type_hosting',
        'predecessor_app',
        'sub_unit'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function opd(): HasOne
    {
        return $this->hasOne(Opd::class, 'id', 'opd_id');
    }
    public function statusapp(): HasOne
    {
        return $this->hasOne(StatusAplikasi::class, 'code', 'status');
    }
    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'code', 'sub_unit');
    }
    
    public function server(): HasOne
    {
        return $this->hasOne(Servers::class, 'id', 'server_id');
    }
}
