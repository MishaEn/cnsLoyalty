FROM php:8-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
USER www-data:www-data
WORKDIR /var/www
CMD ["php-fpm"]