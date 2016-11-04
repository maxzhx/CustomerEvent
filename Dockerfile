FROM php:5.6-apache
RUN apt-get update && apt-get install -y libmemcached-dev \
  libssl-dev \
  && pecl install mongo \
  && docker-php-ext-enable mongo
COPY src /var/www/html/
