# Imagen base PHP-FPM con extensiones necesarias
FROM php:8.2-fpm-alpine

# Instalar extensiones de PHP necesarias para Laravel
RUN apk add --no-cache \
        bash \
        curl \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        libxpm-dev \
        oniguruma-dev \
        libxml2-dev \
        zip \
        unzip \
        git \
        mysql-client \
        npm \
        nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml opcache

# Configurar directorio de trabajo
WORKDIR /var/www/Ni.Robots

# Copiar proyecto al contenedor
COPY Ni.Robots/ /var/www/Ni.Robots/

# Copiar entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Usar entrypoint
ENTRYPOINT ["entrypoint.sh"]

# Comando por defecto
CMD ["php-fpm"]
