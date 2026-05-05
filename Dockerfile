FROM php:8.2-fpm

RUN docker-php-ext-install pdo

RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./www /var/www/html
COPY ./tests /var/www/html/tests

CMD ["php-fpm"]

