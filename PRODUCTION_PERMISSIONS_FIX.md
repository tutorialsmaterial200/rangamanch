# Production Deployment - Permission & Configuration Fix

## The Issue
On production servers, you may encounter:
```
There is no existing directory at "/path/to/storage/logs" and it could not be created: Permission denied
```

This happens because:
1. Web server user (Apache/Nginx) and app user have different permissions
2. Storage directories weren't created with correct ownership
3. Laravel cache files are locked by different processes

## ✅ Solution for Production Server

### Step 1: Create Directories with Correct Ownership
```bash
# On production server as root/sudo
cd /var/www/rangamanch

# Create directories
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/views  
mkdir -p storage/framework/sessions
mkdir -p storage/app/uploads
mkdir -p bootstrap/cache

# Set ownership to web server user
sudo chown -R www-data:www-data storage bootstrap/cache

# Set permissions (web server needs write access)
sudo chmod -R 755 storage bootstrap/cache
```

### Step 2: Alternative for Shared Hosting
If you can't change ownership, use higher permissions:
```bash
chmod -R 777 storage bootstrap/cache
```

### Step 3: Disable Config Caching on First Run
Update your `.env` on production:
```
CACHE_DRIVER=array
```

This uses in-memory caching during setup. After verification, change to:
```
CACHE_DRIVER=file
```

### Step 4: Run Setup Commands
```bash
cd /var/www/rangamanch

# Don't use config cache on first run
# php artisan config:clear (skip this)

# Run migrations
php artisan migrate --force

# Test if logs work
php artisan tinker
# Type: Log::info('Test log message');
# Type: exit;

# Verify log was created
cat storage/logs/laravel.log | tail -5
```

### Step 5: After Testing, Enable Optimization
```bash
php artisan config:cache
php artisan route:cache  
php artisan view:cache
php artisan optimize
```

---

## 🔍 Troubleshooting

### If You Still Get Permission Denied:

```bash
# Check current permissions
ls -la storage/
ls -la bootstrap/cache/

# Check web server user
ps aux | grep apache   # or nginx
# Look for user like 'www-data' or 'daemon'

# Set ownership to correct user (replace www-data if different)
sudo chown -R www-data:www-data storage bootstrap/cache

# Set permissions
sudo chmod -R 755 storage bootstrap/cache
sudo chmod -R 644 storage/logs/laravel.log  # After it's created
```

### SELinux (CentOS/RHEL)
If on CentOS/RHEL with SELinux:
```bash
sudo semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/rangamanch/storage(/.*)?"
sudo restorecon -R /var/www/rangamanch/storage
```

### Docker Containers
```dockerfile
# In Dockerfile after copying files:
RUN chown -R www-data:www-data /var/www/rangamanch/storage
RUN chmod -R 755 /var/www/rangamanch/storage
RUN chmod -R 755 /var/www/rangamanch/bootstrap/cache
```

---

## 📋 Production Deployment Checklist

- [ ] Create storage directories
- [ ] Set correct ownership (www-data or nginx user)
- [ ] Set correct permissions (755 or 777)
- [ ] Update `.env` with production values
- [ ] Generate app key: `php artisan key:generate`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Set `CACHE_DRIVER=array` initially for testing
- [ ] Verify logs are created: `tail storage/logs/laravel.log`
- [ ] Test file uploads work
- [ ] Enable optimization: `php artisan config:cache`
- [ ] Set `CACHE_DRIVER=file` after testing

---

## 🚀 Quick Production Deploy Script

Save as `deploy.sh`:
```bash
#!/bin/bash
set -e

REPO_URL="https://github.com/tutorialsmaterial200/rangamanch.git"
DEPLOY_DIR="/var/www/rangamanch"
WEB_USER="www-data"  # Change if different on your server

echo "🚀 Deploying Rangamanch..."

# Clone or pull
if [ -d "$DEPLOY_DIR" ]; then
    echo "📦 Updating existing deployment..."
    cd "$DEPLOY_DIR"
    git pull origin main
else
    echo "📦 Cloning repository..."
    git clone "$REPO_URL" "$DEPLOY_DIR"
    cd "$DEPLOY_DIR"
fi

# Install dependencies
echo "📥 Installing dependencies..."
composer install --optimize-autoloader --no-dev

# Setup directories
echo "📁 Creating storage directories..."
mkdir -p storage/logs storage/framework/cache storage/framework/views storage/framework/sessions storage/app/uploads
mkdir -p bootstrap/cache

# Set permissions
echo "🔒 Setting permissions..."
sudo chown -R "$WEB_USER:$WEB_USER" storage bootstrap/cache
chmod -R 755 storage bootstrap/cache

# Setup environment
echo "⚙️ Setting up environment..."
if [ ! -f .env ]; then
    cp .env.production .env
fi

# Generate key if needed
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate
fi

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# Rebuild caches
echo "⚡ Building caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set final permissions
echo "🔒 Final permissions..."
chmod -R 644 storage/logs/laravel.log 2>/dev/null || true
sudo chown -R "$WEB_USER:$WEB_USER" bootstrap/cache

echo "✅ Deployment complete!"
echo "🌐 Visit: https://rangamanch.com"
```

Usage:
```bash
sudo bash deploy.sh
```

---

**Note**: Adjust `www-data` if your server uses a different web user (nginx, apache, daemon, etc.)
