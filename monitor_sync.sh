#!/bin/bash

echo "=== Inventory Sync Monitor ==="
echo "Time: $(date)"
echo ""

# Check if AMS directory exists
if [ ! -d "/Library/WebServer/ams" ]; then
    echo "❌ AMS directory not found!"
    exit 1
fi

cd /Library/WebServer/ams

# Check environment variables
echo "🔧 Environment Check:"
if grep -q "INVENTORY_API_URL" .env; then
    echo "✅ INVENTORY_API_URL: Found"
else
    echo "❌ INVENTORY_API_URL: Not found"
fi

if grep -q "INVENTORY_API_AUTH" .env; then
    echo "✅ INVENTORY_API_AUTH: Found"
else
    echo "❌ INVENTORY_API_AUTH: Not found"
fi

echo ""

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

echo ""

# Check Laravel scheduler
echo "📅 Laravel Scheduler:"
SCHEDULE_COUNT=$(php artisan schedule:list 2>/dev/null | grep -c "inventory:sync")
if [ "$SCHEDULE_COUNT" -gt 0 ]; then
    echo "✅ inventory:sync scheduled ($SCHEDULE_COUNT entries)"
else
    echo "❌ inventory:sync not scheduled"
fi

echo ""

# Test API connection
echo "🌐 API Connection Test:"
API_RESPONSE=$(php artisan tinker --execute="try { \$response = Http::withHeaders(['Authorization' => 'Basic c2lwITIxMiM6ITgzazY0SmFkZGFoIw=='])->get('https://owa.bantenprov.go.id/api/get/only/record/=bantenprov.go.id'); echo \$response->status() === 200 ? '✅ API Connected' : '❌ API Error: ' . \$response->status(); } catch (Exception \$e) { echo '❌ API Error: ' . \$e->getMessage(); }" 2>/dev/null)
echo "$API_RESPONSE"

echo ""
echo "========================"

