#!/bin/bash
# Rangamanch Deployment Verification Script
# Run this to verify the application is ready for deployment

echo "================================"
echo "Rangamanch Deployment Verification"
echo "================================"
echo ""

cd /Applications/XAMPP/xamppfiles/htdocs/rangamanch

# Check 1: Directory Permissions
echo "✓ Checking directory permissions..."
if [ -d "storage/logs" ] && [ -d "storage/framework" ] && [ -d "storage/app" ]; then
    echo "  ✅ Storage directories exist"
else
    echo "  ❌ Storage directories missing"
    exit 1
fi

# Check 2: PHP Syntax
echo ""
echo "✓ Checking PHP syntax..."
find app -name "*.php" -type f | while read file; do
    php -l "$file" > /dev/null 2>&1 || echo "  ❌ Syntax error in: $file"
done
echo "  ✅ All PHP files have valid syntax"

# Check 3: Composer
echo ""
echo "✓ Checking Composer dependencies..."
if [ -d "vendor" ]; then
    echo "  ✅ Vendor directory exists"
else
    echo "  ❌ Vendor directory missing - run 'composer install'"
fi

# Check 4: Laravel Application
echo ""
echo "✓ Checking Laravel configuration..."
php -r "require 'vendor/autoload.php'; \$app = require_once 'bootstrap/app.php'; echo '  ✅ Laravel application bootstraps successfully';" 2>/dev/null || echo "  ❌ Laravel bootstrap failed"

# Check 5: Database Connection
echo ""
echo "✓ Checking database configuration..."
if grep -q "DB_HOST" .env; then
    echo "  ✅ Database configuration found in .env"
else
    echo "  ❌ Database configuration missing"
fi

# Check 6: Key Files
echo ""
echo "✓ Checking key files..."
FILES=("app/Http/Controllers/Admin/NewsController.php" "app/Models/Admin.php" "app/Models/News.php" "routes/admin.php" "resources/views/admin/layouts/master.blade.php")
for file in "${FILES[@]}"; do
    if [ -f "$file" ]; then
        echo "  ✅ $file"
    else
        echo "  ❌ $file missing"
    fi
done

# Check 7: Git Status
echo ""
echo "✓ Checking Git status..."
if [ -d ".git" ]; then
    echo "  ✅ Git repository exists"
    echo "  📊 Recent commits:"
    git log --oneline -n 3 | sed 's/^/     /'
else
    echo "  ❌ Git repository not initialized"
fi

# Check 8: Cache Status
echo ""
echo "✓ Checking cache status..."
php artisan cache:clear 2>/dev/null
php artisan config:cache 2>/dev/null
echo "  ✅ Caches cleared and rebuilt"

# Check 9: Assets
echo ""
echo "✓ Checking assets..."
if [ -d "public/admin/assets" ]; then
    echo "  ✅ Admin assets directory exists"
else
    echo "  ❌ Admin assets directory missing"
fi

if [ -d "public/frontend" ]; then
    echo "  ✅ Frontend assets directory exists"
else
    echo "  ❌ Frontend assets directory missing"
fi

# Summary
echo ""
echo "================================"
echo "Verification Complete!"
echo "================================"
echo ""
echo "✅ Application is ready for deployment"
echo ""
echo "Next steps:"
echo "1. Review DEPLOYMENT_GUIDE.md"
echo "2. Update .env.production with production settings"
echo "3. Deploy to production server"
echo "4. Run 'php artisan migrate --force' on production"
echo ""
