FROM php:7.2.6-apache-stretch

LABEL Author="nathan" Description="Server apache2 PHP7.2 for Laravel 5.6" Version="v1.0.0"

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && docker-php-ext-install pdo pdo_mysql
RUN apt-get install -y libpng-dev&& docker-php-ext-install gd

RUN a2enmod rewrite
