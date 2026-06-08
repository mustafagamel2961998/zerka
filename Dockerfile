FROM php:8.2-fpm

# 1. Set working directory
WORKDIR /var/www

# 2. Install system dependencies (ضفنا هنا libxml2-dev و zlib1g-dev عشان الـ DOM والـ XML)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions 
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml zip curl

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy application files
COPY . .

# 6. Install PHP dependencies
# 6. Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs
# 7. Change ownership
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["sh", "-lc", "chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && chmod -R 775 /var/www/storage /var/www/bootstrap/cache && exec php-fpm"]