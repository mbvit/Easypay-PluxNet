#!/bin/sh
set -e

echo "🚀 Starting EasyPay PluxNet application..."

# Validate required environment variables
if [ -z "$APP_KEY" ]; then
    echo "❌ ERROR: APP_KEY is not set!"
    echo "Generate one with: php artisan key:generate --show"
    exit 1
fi

# Ensure database directory and file have correct permissions
echo "📦 Setting up database permissions..."
if [ -d "/var/www/database" ]; then
    # Ensure directory is writable
    chmod 775 /var/www/database
    
    # Create SQLite database if it doesn't exist
    if [ ! -f "/var/www/database/database.sqlite" ]; then
        echo "📦 Creating SQLite database..."
        touch /var/www/database/database.sqlite
    fi
    
    # Ensure database file is writable
    chmod 664 /var/www/database/database.sqlite
fi

# Run database migrations
echo "🔄 Running database migrations..."
php artisan migrate --force --no-interaction

# Clear and cache configuration for production
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
# Skip view cache as it can cause issues with dynamic components
# php artisan view:cache

echo "✅ Application ready!"

# Execute the main command (passed as arguments)
exec "$@"
