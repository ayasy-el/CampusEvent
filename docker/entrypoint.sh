#!/bin/bash
set -e

echo "Starting Laravel application..."

# Install composer dependencies if vendor folder doesn't exist
if [ ! -d "/var/www/vendor" ]; then
    echo "📦 Installing composer dependencies..."
    composer install --no-dev --optimize-autoloader
fi

# Wait for database to be ready (optional, for external DB might not be needed)
echo "⏳ Waiting for database connection..."
until php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; do
    echo "Database not ready, retrying in 3 seconds..."
    sleep 3
done
echo "✅ Database connected!"

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Clear and cache config
echo "🔧 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "✅ Application ready!"

# Start PHP-FPM
exec php-fpm
