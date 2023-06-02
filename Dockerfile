FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y libzip-dev zip unzip \
    && docker-php-ext-install zip

RUN apt-get install -y librabbitmq-dev \
    && pecl install amqp \
    && docker-php-ext-enable amqp