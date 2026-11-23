FROM php:8.5-apache

RUN apt-get update
RUN apt-get install -y libzip-dev unzip git
RUN docker-php-ext-install pdo pdo_mysql zip
