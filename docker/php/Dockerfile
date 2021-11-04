FROM composer:2.1 as builder

WORKDIR /app

COPY ./composer.* ./
RUN composer install --no-interaction

FROM php:8.0-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=builder /app/composer.lock /tmp
COPY --from=builder /app/vendor /tmp/vendor

USER 1000

CMD ["sh", "-c", "cp -r /tmp/* /var/www/html"]
