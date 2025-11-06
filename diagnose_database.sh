#!/bin/bash
# Database Connection Diagnostic Script
# Run this to diagnose database connection issues

echo "================================"
echo "Database Connection Diagnostics"
echo "================================"
echo ""

cd /Applications/XAMPP/xamppfiles/htdocs/rangamanch

# Check 1: Read current .env settings
echo "✓ Current Database Settings (.env):"
grep "^DB_" .env | sed 's/^/  /'
echo ""

# Check 2: Test MySQL connection
echo "✓ Testing MySQL Connection..."
php -r "
try {
    \$conn = new mysqli('127.0.0.1', 'root', '', 'rang_rangamanch');
    if (\$conn->connect_error) {
        echo '  ❌ Connection failed: ' . \$conn->connect_error . PHP_EOL;
    } else {
        echo '  ✅ MySQL connection successful' . PHP_EOL;
        \$conn->close();
    }
} catch (Exception \$e) {
    echo '  ❌ Error: ' . \$e->getMessage() . PHP_EOL;
}
"
echo ""

# Check 3: Laravel database test
echo "✓ Laravel Database Test:"
php artisan tinker << 'EOF'
try {
    DB::connection()->getPdo();
    echo "  ✅ Laravel DB connection successful\n";
} catch (Exception $e) {
    echo "  ❌ Laravel DB error: " . $e->getMessage() . "\n";
}
exit;
EOF
echo ""

# Check 4: Check if database exists
echo "✓ Checking Databases:"
mysql -u root -e "SHOW DATABASES LIKE 'rang%';" 2>/dev/null | sed 's/^/  /'
echo ""

# Check 5: Check MySQL users
echo "✓ Available MySQL Users:"
mysql -u root -e "SELECT user, host FROM mysql.user WHERE user LIKE 'rang%';" 2>/dev/null || mysql -u root -e "SELECT user, host FROM mysql.user;" 2>/dev/null | head -10 | sed 's/^/  /'
echo ""

# Check 6: Test Laravel query
echo "✓ Testing News Query:"
php artisan tinker << 'EOF'
try {
    $news = DB::table('news')
        ->where('is_breaking_news', 1)
        ->where('status', 1)
        ->where('is_approved', 1)
        ->where('language', 'en')
        ->orderBy('id', 'desc')
        ->limit(5)
        ->get();
    echo "  ✅ Query successful - Found " . count($news) . " breaking news\n";
} catch (Exception $e) {
    echo "  ❌ Query error: " . $e->getMessage() . "\n";
}
exit;
EOF
echo ""

# Check 7: Check Laravel logs
echo "✓ Recent Error Logs:"
if [ -f "storage/logs/laravel.log" ]; then
    tail -10 storage/logs/laravel.log | grep -i "error\|exception\|access\|denied" | head -5 | sed 's/^/  /' || echo "  (No recent DB errors)"
else
    echo "  (Log file not found)"
fi
echo ""

echo "================================"
echo "Diagnostics Complete"
echo "================================"
echo ""
echo "If you're getting 'Access denied' errors:"
echo "1. Read: DATABASE_CONNECTION_FIX.md"
echo "2. Update .env with correct credentials"
echo "3. Run: php artisan config:clear"
echo "4. Re-run this script to verify"
echo ""
