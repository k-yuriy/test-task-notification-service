FROM php:8.3-fpm

ARG UID=501

ARG GID=20

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql sockets

# composer

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer \
    && chmod +x /usr/bin/composer

# создаём пользователя (ВАЖНО: именно так)

RUN useradd -m -u ${UID} -g ${GID} -s /bin/bash appuser

WORKDIR /var/www

USER appuser