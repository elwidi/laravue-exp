FROM nginx:stable-alpine AS stage-web

WORKDIR /var/www/html

COPY nginx/default.conf /etc/nginx/conf.d/default.conf

COPY Apps/ /var/www/html


FROM php:8.1.11-fpm-buster AS stage-php

ARG NODE_VERSION=18

WORKDIR /var/www/html

COPY Apps/ /var/www/html

RUN docker-php-ext-install bcmath pdo_mysql

RUN apt-get update
RUN apt-get install -y git zip unzip

#setup oracle client
RUN apt-get install -y libaio1

RUN php -d extension=/path/to/extension.so

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev


RUN curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm

# Set the appropriate permissions
RUN chown -R www-data:www-data /var/www/html

RUN chmod -R 777 /var/www/html/storage/

EXPOSE 9000