#!/bin/bash

echo "🚀 Setting up Inventory Sync Cronjob for AMS"
echo "=============================================="

# Check if running as root
if [ "$EUID" -eq 0 ]; then
    echo "⚠️  Running as root. Please run as regular user."
    exit 1
fi

# Check if AMS directory exists
if [ ! -d "/Library/WebServer/ams" ]; then
    echo "❌ AMS directory not found at /Library/WebServer/ams"
    echo "Please make sure AMS is installed in the correct location"
    exit 1
fi

cd /Library/WebServer/ams

echo "✅ AMS directory found"

# Step 1: Check environment variables
echo ""
echo "🔧 Checking environment variables..."
if grep -q "INVENTORY_API_URL" .env; then
    echo "✅ INVENTORY_API_URL found"
else
    echo "❌ INVENTORY_API_URL not found in .env"
    echo "Please add: INVENTORY_API_URL=https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id"
fi

if grep -q "INVENTORY_API_AUTH" .env; then
    echo "✅ INVENTORY_API_AUTH found"
else
    echo "❌ INVENTORY_API_AUTH not found in .env"
    echo "Please add: INVENTORY_API_AUTH=\"Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw==\""
fi

# Step 2: Test command
echo ""
echo "🧪 Testing inventory sync command..."
if php artisan inventory:sync > /dev/null 2>&1; then
    echo "✅ Command test successful"
else
    echo "❌ Command test failed"
    echo "Please check Laravel installation and dependencies"
    exit 1
fi

# Step 3: Check current crontab
echo ""
echo "⏰ Checking current crontab..."
CURRENT_CRON=$(crontab -l 2>/dev/null)
if echo "$CURRENT_CRON" | grep -q "ams.*schedule:run"; then
    echo "✅ AMS cronjob already exists"
    echo "Current crontab:"
    echo "$CURRENT_CRON"
else
    echo "📝 Adding AMS cronjob..."
    
    # Create new crontab entry
    NEW_CRON="* * * * * cd /Library/WebServer/ams && php artisan schedule:run >> /dev/null 2>&1"
    
    if [ -z "$CURRENT_CRON" ]; then
        # No existing crontab
        echo "$NEW_CRON" | crontab -
    else
        # Add to existing crontab
        (echo "$CURRENT_CRON"; echo "$NEW_CRON") | crontab -
    fi
    
    echo "✅ Cronjob added successfully"
fi

# Step 4: Check Laravel scheduler
echo ""
echo "📅 Checking Laravel scheduler..."
SCHEDULE_COUNT=$(php artisan schedule:list 2>/dev/null | grep -c "inventory:sync")
if [ "$SCHEDULE_COUNT" -gt 0 ]; then
    echo "✅ inventory:sync is scheduled ($SCHEDULE_COUNT entries)"
else
    echo "❌ inventory:sync not found in scheduler"
    echo "Please check app/Console/Kernel.php"
fi

# Step 5: Test schedule run
echo ""
echo "🔄 Testing schedule run..."
if php artisan schedule:run > /dev/null 2>&1; then
    echo "✅ Schedule run test successful"
else
    echo "❌ Schedule run test failed"
fi

# Step 6: Check permissions
echo ""
echo "🔐 Checking file permissions..."
if [ -w "storage/logs" ]; then
    echo "✅ Log directory writable"
else
    echo "❌ Log directory not writable"
    echo "Run: chmod -R 755 storage/logs/"
fi

# Step 7: Create monitoring script
echo ""
echo "📊 Creating monitoring script..."
cat > monitor_sync.sh << 'EOF'
#!/bin/bash

echo "=== Inventory Sync Monitor ==="
echo "Time: $(date)"
echo ""

cd /Library/WebServer/ams

# Check last sync log
echo "📋 Last Sync Activity:"
LAST_SYNC=$(grep -i "inventory.*sync" storage/logs/laravel.log | tail -1)
if [ -n "$LAST_SYNC" ]; then
    echo "✅ $LAST_SYNC"
else
    echo "❌ No sync activity found in logs"
fi

echo ""

# Check database status
echo "🗄️ Database Status:"
ACTIVE_COUNT=$(php artisan tinker --execute="echo App\Inventory::where('status', 'active')->count();" 2>/dev/null)
API_COUNT=$(php artisan tinker --execute="echo App\Inventory::where('sync_source', 'api')->count();" 2>/dev/null)
LOCAL_COUNT=$(php artisan tinker --execute="echo App\Inventory::where('sync_source', 'local')->count();" 2>/dev/null)

echo "Active Records: $ACTIVE_COUNT"
echo "API Records: $API_COUNT"
echo "Local Records: $LOCAL_COUNT"

echo ""

# Check cronjob
echo "⏰ Cronjob Status:"
if crontab -l 2>/dev/null | grep -q "ams.*schedule:run"; then
    echo "✅ AMS cronjob found"
else
    echo "❌ AMS cronjob not found"
fi

echo "========================"
EOF

chmod +x monitor_sync.sh
echo "✅ Monitoring script created: monitor_sync.sh"

# Step 8: Final verification
echo ""
echo "🎯 Final Verification:"
echo "1. Cronjob setup: $(crontab -l | grep -c "ams.*schedule:run") entries"
echo "2. Laravel scheduler: $(php artisan schedule:list | grep -c "inventory:sync") entries"
echo "3. Command test: $(php artisan inventory:sync > /dev/null 2>&1 && echo "PASS" || echo "FAIL")"

echo ""
echo "✅ Setup completed!"
echo ""
echo "📋 Next steps:"
echo "1. Monitor sync: ./monitor_sync.sh"
echo "2. Check logs: tail -f storage/logs/laravel.log"
echo "3. Manual sync: php artisan inventory:sync"
echo "4. View schedule: php artisan schedule:list"
echo ""
echo "🕒 Sync will run automatically every hour"

