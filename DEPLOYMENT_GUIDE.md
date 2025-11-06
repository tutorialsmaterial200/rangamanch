# Rangamanch Deployment Guide

## Pre-Deployment Checklist ✅

### 1. Local Environment
- [x] All directories created: `storage/logs`, `storage/framework`, `storage/app`
- [x] Permissions set (777 on storage and cache directories)
- [x] Git repository initialized and all files committed
- [x] Environment configured (.env setup)
- [x] All caches cleared and rebuilt
- [x] Application boots without errors

### 2. Application Status
- [x] No syntax errors in PHP files
- [x] All models, controllers, and helpers validated
- [x] Database migrations ready
- [x] File upload functionality working (form and modal)
- [x] Admin layout with proper asset loading

### 3. Key Files & Configurations
- **.env**: Contains local database and mail configuration
- **.gitignore**: Properly excludes sensitive files
- **public/index.php**: Entry point properly configured
- **routes/**: All routes configured (web, admin, api)
- **storage/**: All subdirectories created with 777 permissions

## Deployment Steps

### Step 1: Copy to Production Server
```bash
# From local machine, use SCP or FTP to upload to your server:
# scp -r /Applications/XAMPP/xamppfiles/htdocs/rangamanch/* user@server:/var/www/rangamanch/
```

### Step 2: On Production Server
```bash
cd /var/www/rangamanch

# Create storage directories
mkdir -p storage/logs storage/framework/cache storage/framework/views storage/framework/sessions storage/app/uploads

# Set permissions (adjust if using different user)
chmod -R 777 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache  # For Apache/Nginx

# Install dependencies
composer install --optimize-autoloader --no-dev

# Set production environment
echo "APP_ENV=production" >> .env
echo "APP_DEBUG=false" >> .env
echo "APP_URL=https://rangamanch.com" >> .env

# Update database connection if needed
# nano .env (edit DB_HOST, DB_USERNAME, DB_PASSWORD)

# Generate app key (if not already set)
php artisan key:generate

# Clear old caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild optimized caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Run migrations (if needed)
php artisan migrate --force

# Set file permissions
chmod -R 755 storage bootstrap/cache
```

### Step 3: Configure Web Server

**For Apache (.htaccess in public/):**
```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

**For Nginx:**
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

### Step 4: SSL Certificate (HTTPS)
```bash
# Using Let's Encrypt with Certbot
sudo certbot certonly --webroot -w /var/www/rangamanch/public -d rangamanch.com -d www.rangamanch.com

# Configure auto-renewal
sudo certbot renew --dry-run
```

### Step 5: Post-Deployment Verification
```bash
# Check application is running
php artisan tinker
# Type: DB::connection()->getPdo();  # Should show connected
# Type: exit;

# Check logs for errors
tail -f storage/logs/laravel.log

# Verify uploads work
chmod 777 public/uploads storage/app/uploads

# Test mail (optional)
php artisan tinker
# Type: Mail::raw('Test', function($m) { $m->to('admin@gmail.com'); });
```

## Important Variables for Production

Update in production .env:
- `APP_URL=https://rangamanch.com`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `DB_HOST=` (your production database host)
- `DB_USERNAME=` (your production db user)
- `DB_PASSWORD=` (your production db password)
- `MAIL_HOST=` (your production mail server)

## Rollback Plan

If deployment fails:
```bash
# Keep a backup
tar -czf backup-$(date +%Y%m%d).tar.gz /var/www/rangamanch/

# Restore if needed
tar -xzf backup-*.tar.gz
```

## Monitoring

- Check `storage/logs/laravel.log` regularly
- Monitor server disk space
- Set up cron jobs for queue if needed
- Monitor database performance

---

**Last Updated**: November 6, 2025
**Status**: Ready for Production Deployment ✅
