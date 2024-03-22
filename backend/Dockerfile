FROM php:8.1-fpm

# set your user name, ex: user=bernardo
ARG user=scs
ARG uid=1000

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        apt-utils \
    && apt-get install -y \
        libpq-dev \
        libzip-dev \
        && docker-php-ext-install -j$(nproc) zip \
        && docker-php-ext-install -j$(nproc) pdo_mysql \
        && docker-php-ext-install -j$(nproc) bcmath

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

WORKDIR /var/www

EXPOSE 9000

USER $user