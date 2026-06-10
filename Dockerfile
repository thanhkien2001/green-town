FROM php:8.4-cli

# Cài thư viện hệ thống + Node.js + Yarn
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    gnupg \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev

# Cài Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Cài Yarn
RUN npm install -g yarn

# Cài extension PHP
RUN docker-php-ext-configure gd \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy source code
COPY . .

# Cài package PHP
RUN composer install --no-dev --optimize-autoloader

# Cài package JS
RUN yarn install

# Build frontend
RUN yarn prod

# Laravel optimize
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
