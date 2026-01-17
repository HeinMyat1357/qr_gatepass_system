#!/bin/sh
set -e



# --------------------------
# Clean old logs and cache
# --------------------------
rm -rf /var/www/html/storage/logs/*
rm -rf /var/www/html/bootstrap/cache/*

# --------------------------
# Ensure storage folders exist
# --------------------------
mkdir -p /var/www/html/storage/framework/{views,cache,sessions,testing}
mkdir -p /var/www/html/storage/logs /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# --------------------------
# Run migrations & seeders
# --------------------------
php /var/www/html/artisan migrate --force
php /var/www/html/artisan db:seed --force || true

# --------------------------
# Ensure storage symlink exists
# --------------------------
php /var/www/html/artisan storage:link || true

# --------------------------
# Clear caches safely
# --------------------------
php /var/www/html/artisan config:clear
php /var/www/html/artisan route:clear
php /var/www/html/artisan view:clear
php /var/www/html/artisan cache:clear

# --------------------------
# Start Apache
# --------------------------
exec apache2-foreground
