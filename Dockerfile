FROM php:8.1-cli

RUN pecl install xdebug-3.1.4 && docker-php-ext-enable xdebug