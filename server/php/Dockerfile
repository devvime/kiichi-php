FROM php:8.2-fpm

# Instalar extensões e dependências
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql gd

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Copia o código da aplicação
COPY . /var/www

# Ajusta permissões (depois de copiar)
RUN mkdir -p /var/www/server/cache && \
    chown -R www-data:www-data /var/www/server/cache && \
    chmod -R 775 /var/www/server/cache

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www


WORKDIR /var/www/public