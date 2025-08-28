# 🕒 Panduan Implementasi Cronjob di VM

## **Step 1: Setup Laravel Scheduler di VM**

### 1.1 Cek Cronjob yang Sudah Ada
```bash
crontab -l
```

### 1.2 Tambahkan Laravel Scheduler untuk AMS
```bash
# Edit crontab
crontab -e

# Tambahkan baris berikut:
* * * * * cd /path/to/ams && php artisan schedule:run >> /dev/null 2>&1
```

**Contoh untuk path AMS:**
```bash
* * * * * cd /Library/WebServer/ams && php artisan schedule:run >> /dev/null 2>&1
```

### 1.3 Jika Ada Multiple Laravel Projects
Jika sudah ada cronjob untuk project lain, gabungkan:
```bash
# Cek cronjob existing
crontab -l

# Edit dan tambahkan untuk AMS
crontab -e

# Contoh hasil akhir:
* * * * * cd /Library/WebServer/cms-content && php artisan schedule:run > /dev/null 2>&1
* * * * * cd /Library/WebServer/ams && php artisan schedule:run >> /dev/null 2>&1
```

## **Step 2: Verifikasi Environment Variables**

### 2.1 Pastikan .env File Sudah Benar
```bash
# Cek file .env di VM
cat /Library/WebServer/ams/.env | grep INVENTORY_API
```

**Pastikan ada:**
```env
INVENTORY_API_URL=https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id
INVENTORY_API_AUTH="Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw=="
```

### 2.2 Test Environment Variables
```bash
cd /Library/WebServer/ams
php artisan tinker --execute="echo env('INVENTORY_API_URL') . PHP_EOL; echo env('INVENTORY_API_AUTH') . PHP_EOL;"
```

## **Step 3: Test Command Manual**

### 3.1 Test Command Sync
```bash
cd /Library/WebServer/ams
php artisan inventory:sync
```

### 3.2 Test Schedule List
```bash
php artisan schedule:list
```

## **Step 4: Setup Logging**

### 4.1 Pastikan Log Directory Writable
```bash
# Cek permission
ls -la /Library/WebServer/ams/storage/logs/

# Jika perlu, set permission
chmod -R 755 /Library/WebServer/ams/storage/logs/
chown -R www-data:www-data /Library/WebServer/ams/storage/logs/
```

### 4.2 Cek Log File
```bash
# Monitor log real-time
tail -f /Library/WebServer/ams/storage/logs/laravel.log

# Cek log terakhir
tail -20 /Library/WebServer/ams/storage/logs/laravel.log
```

## **Step 5: Monitoring dan Troubleshooting**

### 5.1 Cek Cronjob Berjalan
```bash
# Cek apakah cron service berjalan
sudo systemctl status cron

# Restart cron jika perlu
sudo systemctl restart cron
```

### 5.2 Test Cronjob Manual
```bash
# Test schedule:run manual
cd /Library/WebServer/ams
php artisan schedule:run

# Test command specific
php artisan inventory:sync
```

### 5.3 Monitor dengan Log
```bash
# Buat script monitoring
cat > /Library/WebServer/ams/monitor_sync.sh << 'EOF'
#!/bin/bash
echo "=== Inventory Sync Monitor ==="
echo "Time: $(date)"
echo "Last log entries:"
tail -5 /Library/WebServer/ams/storage/logs/laravel.log | grep -i "inventory\|sync"
echo "========================"
EOF

chmod +x /Library/WebServer/ams/monitor_sync.sh

# Jalankan monitoring
/Library/WebServer/ams/monitor_sync.sh
```

## **Step 6: Advanced Configuration**

### 6.1 Custom Schedule (Opsional)
Jika ingin schedule berbeda, edit `app/Console/Kernel.php`:

```php
// Setiap 30 menit
$schedule->command('inventory:sync')->everyThirtyMinutes();

// Setiap 2 jam
$schedule->command('inventory:sync')->everyTwoHours();

// Setiap hari jam 2 pagi
$schedule->command('inventory:sync')->dailyAt('02:00');

// Setiap Senin jam 8 pagi
$schedule->command('inventory:sync')->weekly()->mondays()->at('08:00');
```

### 6.2 Email Notification (Opsional)
```php
// Di app/Console/Kernel.php
$schedule->command('inventory:sync')
    ->hourly()
    ->emailOutputTo('admin@example.com');
```

## **Step 7: Verification Checklist**

- [ ] Cronjob ditambahkan ke crontab
- [ ] Environment variables sudah benar
- [ ] Command manual berjalan tanpa error
- [ ] Log directory writable
- [ ] Laravel scheduler berjalan
- [ ] Sync berjalan otomatis setiap jam
- [ ] Log menunjukkan aktivitas sync

## **Step 8: Troubleshooting Common Issues**

### Issue 1: Permission Denied
```bash
# Set permission
sudo chown -R www-data:www-data /Library/WebServer/ams/
sudo chmod -R 755 /Library/WebServer/ams/
```

### Issue 2: Path Not Found
```bash
# Pastikan path benar
pwd
ls -la /Library/WebServer/ams/artisan
```

### Issue 3: Environment Variables Not Loaded
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear
```

### Issue 4: Database Connection Issues
```bash
# Test database connection
php artisan tinker --execute="echo 'DB connected: ' . (DB::connection()->getPdo() ? 'YES' : 'NO') . PHP_EOL;"
```

## **Step 9: Maintenance**

### 9.1 Regular Monitoring
```bash
# Buat script untuk daily check
cat > /Library/WebServer/ams/daily_sync_check.sh << 'EOF'
#!/bin/bash
echo "=== Daily Sync Check ==="
echo "Date: $(date)"
echo "Last sync log:"
grep "inventory.*sync" /Library/WebServer/ams/storage/logs/laravel.log | tail -1
echo "Active records count:"
php /Library/WebServer/ams/artisan tinker --execute="echo 'Active: ' . App\Inventory::where('status', 'active')->count() . PHP_EOL;"
echo "====================="
EOF

chmod +x /Library/WebServer/ams/daily_sync_check.sh
```

### 9.2 Log Rotation
```bash
# Setup log rotation (jika belum ada)
sudo nano /etc/logrotate.d/laravel-ams

# Isi dengan:
/Library/WebServer/ams/storage/logs/*.log {
    daily
    missingok
    rotate 52
    compress
    notifempty
    create 644 www-data www-data
}
```

---

## **🎯 Quick Start Commands**

```bash
# 1. Setup cronjob
crontab -e
# Tambahkan: * * * * * cd /Library/WebServer/ams && php artisan schedule:run >> /dev/null 2>&1

# 2. Test manual
cd /Library/WebServer/ams
php artisan inventory:sync

# 3. Monitor
tail -f storage/logs/laravel.log

# 4. Cek status
php artisan schedule:list
```

