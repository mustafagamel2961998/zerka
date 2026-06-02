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
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions (ضفنا xml و dom و curl لأن لارفيل بيحتاجهم حتمًا للكومبوزر)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml

# 4. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Copy application files
COPY . .

# 6. Install PHP dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_MEMORY_LIMIT=-1 composer install \
    --no-interaction \
    --optimize-autoloader \
    --no-dev \
    --ignore-platform-reqs

# 7. Change ownership
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["sh", "-lc", "chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && chmod -R 775 /var/www/storage /var/www/bootstrap/cache && exec php-fpm"]