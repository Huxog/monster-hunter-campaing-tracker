FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    zlib-dev \
    curl-dev \
    autoconf \
    g++ \
    make \
    gcc \
    libtool \
    linux-headers \
    re2c
 RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    xml \
    curl
RUN rm -rf /var/cache/apk/*

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apk del autoconf g++ make gcc curl-dev
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

EXPOSE 9000
