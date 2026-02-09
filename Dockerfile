FROM php:8.2-cli

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy semua file project
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN cp .env.example .env || true
RUN php artisan key:generate || true

# Buka port
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
