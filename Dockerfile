# Start from PHP 8.2 FPM image with system dependencies
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies via Composer
RUN composer install --optimize-autoloader --no-dev

# Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel server
CMD php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=8000
