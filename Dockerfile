FROM php:8.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY wonde /app
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000

