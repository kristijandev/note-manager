FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    nginx \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

COPY . .

RUN composer install --no-interaction --optimize-autoloader
RUN npm install
RUN npm run build

# Copy custom nginx config
COPY ./docker/nginx/default.conf /etc/nginx/sites-available/default

# Expose ports
EXPOSE 80

# Start both php-fpm and nginx in one container
CMD service nginx start && php-fpm
