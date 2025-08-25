# Inventory Sync Service

Service ini digunakan untuk sinkronisasi data inventory dari API eksternal ke database lokal.

## Konfigurasi

Tambahkan konfigurasi berikut di file `.env`:

```env
# Inventory API Configuration
INVENTORY_API_URL=https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id
INVENTORY_API_AUTH="Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw=="
```

**PENTING**: Pastikan nilai `INVENTORY_API_AUTH` diapit dengan tanda kutip ganda untuk menghindari error parsing.

## Fitur

Service ini melakukan sinkronisasi berdasarkan aturan berikut:

1. **Update Status**: Mengambil status dari API berdasarkan IP address
   - Jika status dari API "Deactive" → Update menjadi "inactive" (lowercase)
   - Jika status dari API "Active" → Update menjadi "active" (lowercase)

2. **Update URL**: Jika URL di database tidak sesuai dengan domain di API, maka URL akan diupdate

3. **Mark Inactive**: Jika data di database tidak ada di API, maka status akan diubah menjadi "inactive" (lowercase)

## Penggunaan

### 1. Manual Sync via Command Line

```bash
php artisan inventory:sync
```

**Output yang diharapkan:**
```
Starting inventory synchronization...
Inventory synchronization completed successfully!
```

### 2. Manual Sync via API

```bash
# Trigger sync (memerlukan authentication)
POST /inventory/sync

# Check sync status (memerlukan authentication)
GET /inventory/sync/status
```

### 3. Automatic Sync (Cronjob)

Service ini sudah dikonfigurasi untuk berjalan setiap jam secara otomatis.

Untuk mengaktifkan cronjob, pastikan cron job Laravel sudah berjalan:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Struktur Data

### API Response Format

```json
{
    "status": true,
    "message": "Authorized",
    "data": [
        {
            "Domain": "ns1.bantenprov.go.id",
            "IpAddress": "103.215.154.154",
            "Status": "Active"
        }
    ]
}
```

### Database Mapping

- **IP Address**: Mapped ke tabel `servers.ip`
- **Domain**: Mapped ke tabel `inventories.url`
- **Status**: Mapped ke tabel `inventories.status`

## Logging

Semua aktivitas sinkronisasi akan dicatat di log Laravel. Cek log di:
- `storage/logs/laravel-YYYY-MM-DD.log`

**Contoh log output:**
```
[2025-08-26 05:06:43] local.INFO: Updated inventory ID 144 with changes: {"status":"active"}
[2025-08-26 05:06:43] local.INFO: Updated inventory ID 159 with changes: {"status":"inactive"}
[2025-08-26 05:06:43] local.INFO: Marked inventory ID 2 as inactive (not found in API)
[2025-08-26 05:06:43] local.INFO: Inventory sync process completed successfully
```

## Testing

Service ini sudah diuji dan berfungsi dengan baik:

1. ✅ API dapat diakses dengan authentication yang benar
2. ✅ Data berhasil di-fetch dari API eksternal
3. ✅ Sinkronisasi status berhasil dilakukan
4. ✅ Records yang tidak ada di API berhasil di-mark sebagai inactive
5. ✅ Logging berfungsi dengan baik

## Troubleshooting

1. **API tidak dapat diakses**: Periksa konfigurasi URL dan authentication
2. **Data tidak tersinkronisasi**: Periksa relasi antara tabel `inventories` dan `servers`
3. **Error permission**: Pastikan aplikasi memiliki akses write ke database
4. **Error parsing .env**: Pastikan nilai `INVENTORY_API_AUTH` diapit dengan tanda kutip ganda
5. **Error mass assignment**: Pastikan field `status` dan `url` ada di `$fillable` property model Inventory

## Files yang Dibuat/Dimodifikasi

1. `app/Services/InventorySyncService.php` - Service utama
2. `app/Console/Commands/SyncInventoryCommand.php` - Command untuk CLI
3. `app/Http/Controllers/InventorySyncController.php` - Controller untuk API
4. `app/Console/Kernel.php` - Schedule configuration
5. `app/Inventory.php` - Added server relationship dan fillable properties
6. `routes/web.php` - Added sync routes

## Status Implementasi

- ✅ Service utama dibuat dan berfungsi
- ✅ Command line interface berfungsi
- ✅ API endpoints tersedia (memerlukan auth)
- ✅ Cronjob dikonfigurasi (setiap jam)
- ✅ Logging berfungsi
- ✅ Error handling lengkap
- ✅ Dokumentasi lengkap
