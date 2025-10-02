<?php

namespace App\Exports;

use App\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Inventory::with(['opd', 'category', 'layanan', 'unitPengembang', 'server'])
            ->where('status', 'active');

        // Apply filters
        if (!empty($this->filters['opd_id'])) {
            $query->where('opd_id', $this->filters['opd_id']);
        }
        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }
        if (!empty($this->filters['id_layanan'])) {
            $query->where('scope', $this->filters['id_layanan']);
        }
        if (!empty($this->filters['unit_pengembang'])) {
            $query->where('unit_pengembang', $this->filters['unit_pengembang']);
        }
        if (!empty($this->filters['tahun_pembuatan'])) {
            $query->where('tahun_pembuatan', $this->filters['tahun_pembuatan']);
        }
        if (!empty($this->filters['platform'])) {
            $query->where('platform', $this->filters['platform']);
        }
        if (!empty($this->filters['type_hosting'])) {
            $query->where('type_hosting', $this->filters['type_hosting']);
        }
        if (!empty($this->filters['search'])) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('code', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('url', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('ip_address', 'like', '%' . $this->filters['search'] . '%');
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Aplikasi',
            'Kode Aplikasi',
            'Versi',
            'URL',
            'IP Address',
            'Platform',
            'OPD',
            'Kategori',
            'Layanan',
            'Unit Pengembang',
            'Tahun Pembuatan',
            'Type Hosting',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($inventory): array
    {
        return [
            $inventory->id,
            $inventory->name,
            $inventory->code,
            $inventory->version,
            $inventory->url,
            $inventory->ip_address,
            $inventory->platform,
            $inventory->opd ? $inventory->opd->name : '-',
            $inventory->category ? $inventory->category->name : '-',
            $inventory->layanan ? $inventory->layanan->nama_layanan : '-',
            $inventory->unitPengembang ? $inventory->unitPengembang->nama_unit : '-',
            $inventory->tahun_pembuatan,
            $inventory->type_hosting,
            $inventory->status,
            $inventory->created_at ? $inventory->created_at->format('d/m/Y H:i') : '-',
            $inventory->updated_at ? $inventory->updated_at->format('d/m/Y H:i') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // ID
            'B' => 25,  // Nama Aplikasi
            'C' => 20,  // Kode Aplikasi
            'D' => 10,  // Versi
            'E' => 30,  // URL
            'F' => 15,  // IP Address
            'G' => 15,  // Platform
            'H' => 20,  // OPD
            'I' => 20,  // Kategori
            'J' => 20,  // Layanan
            'K' => 20,  // Unit Pengembang
            'L' => 15,  // Tahun Pembuatan
            'M' => 15,  // Type Hosting
            'N' => 10,  // Status
            'O' => 20,  // Tanggal Dibuat
            'P' => 20,  // Tanggal Diupdate
        ];
    }
}
