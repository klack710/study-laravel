FROM php:7.2-fpm

MAINTAINER Masaki Obata <willow710kut@gmail.com>

RUN apt-get update \
 && apt-get install -y \
    mysql-client \
    && docker-php-ext-install pdo_mysql

RUN apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    iputils-ping \
    net-tools

RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer

COPY ./ /var/www

WORKDIR /var/www
