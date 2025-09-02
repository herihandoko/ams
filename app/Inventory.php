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
        'fungsi',
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
        'sub_unit',
        'sync_source',
        'last_sync_at',
        // New fields
        'refferensi_code',
        'id_layanan',
        'id_data',
        'luaran',
        'inputan_data',
        'supplier_data',
        'luaran_data',
        'customer_data',
        'basis_aplikasi',
        'server_aplikasi',
        'tipe_lisensi',
        'kerangka_pengembangan',
        'unit_pengembang',
        'unit_operasional_teknologi',
        'id_metadata_terkait'
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

    // New relationships
    public function layanan(): HasOne
    {
        return $this->hasOne(Layanan::class, 'id', 'id_layanan');
    }

    public function dataMetadata(): HasOne
    {
        return $this->hasOne(DataMetadata::class, 'id', 'id_data');
    }

    public function serverAplikasi(): HasOne
    {
        return $this->hasOne(Servers::class, 'id', 'server_aplikasi');
    }

    public function unitPengembang(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'unit_pengembang');
    }

    public function unitOperasional(): HasOne
    {
        return $this->hasOne(Unit::class, 'id', 'unit_operasional_teknologi');
    }

    public function metadataSpbe(): HasOne
    {
        return $this->hasOne(MetadataSpbe::class, 'id', 'id_metadata_terkait');
    }
}
