# ============================================
# Stage 1: Build Frontend Assets
# ============================================
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --no-audit --no-fund

# Copy source files needed for build
COPY resources ./resources
COPY public ./public
COPY vite.config.js postcss.config.js tailwind.config.js ./

# Build frontend assets
RUN npm run build


# ============================================
# Stage 2: Install PHP Dependencies
# ============================================
FROM dunglas/frankenphp:latest-php8.2 AS vendor-builder

WORKDIR /app

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install required PHP extensions
RUN install-php-extensions intl pdo_sqlite sqlite3 zip

# Copy composer files
COPY composer.json composer.lock ./

# Install production dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

# Copy application code
COPY . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize --classmap-authoritative


# ============================================
# Stage 3: Production Runtime with FrankenPHP
# ============================================
FROM dunglas/frankenphp:latest-php8.2

# Set working directory
WORKDIR /var/www

# Install required PHP extensions
RUN install-php-extensions intl pdo_sqlite sqlite3 zip

# Copy application files from vendor builder
COPY --from=vendor-builder --chown=www-data:www-data /app /var/www

# Copy built frontend assets from frontend builder
COPY --from=frontend-builder --chown=www-data:www-data /app/public/build /var/www/public/build

# Create required directories and set permissions
RUN mkdir -p \
    storage/framework/{sessions,views,cache} \
    storage/app/public \
    storage/logs \
    bootstrap/cache \
    database \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache database

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port
EXPOSE 8000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=40s --retries=3 \
    CMD ["/usr/local/bin/frankenphp", "healthcheck"]

# Set entrypoint (runs as root to set permissions)
ENTRYPOINT ["docker-entrypoint.sh"]

# Default command: Start FrankenPHP with Laravel
CMD ["frankenphp", "php-server", "--listen", "0.0.0.0:8000", "--root", "/var/www/public"]
