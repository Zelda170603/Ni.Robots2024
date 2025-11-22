# PHP 8.3 (requerido por tus deps)
FROM php:8.3-fpm-alpine

# Paquetes del sistema
RUN apk add --no-cache \
    bash curl git zip unzip \
    icu-dev oniguruma-dev libzip-dev \
    libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev \
    libxml2-dev \
    mariadb-client \
    nodejs npm

# Extensiones PHP (gd con jpeg/webp/xpm; +intl, pdo_mysql, etc.)
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm \
 && docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd xml intl opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/Ni.Robots

# Copiar proyecto
COPY Ni.Robots/ /var/www/Ni.Robots/

# Entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh \
 && sed -i 's/\r$//' /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
