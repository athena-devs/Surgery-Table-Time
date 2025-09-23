FROM php:8.4.10 AS build

WORKDIR /build

RUN apt-get update && apt-get install -y git zip unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json .

COPY composer.lock .

RUN composer install --no-dev


FROM php:8.4.10-alpine

WORKDIR /var/www/html

COPY --from=build /build/vendor /var/www/html/vendor

COPY . .

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public/"]
