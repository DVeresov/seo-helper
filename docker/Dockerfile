FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    intl \
    xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www