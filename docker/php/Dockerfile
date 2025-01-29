FROM php:8.2-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y supervisor

COPY ./supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN apt-get update \
    && apt-get install -y \
        default-mysql-client \
        zlib1g-dev \
        libzip-dev \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        zip \
        gd

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]