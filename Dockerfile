# syntax=docker/dockerfile:1

##############################
# Stage: vendor (composer deps)
##############################
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --optimize-autoloader --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --no-dev --optimize

##############################
# Stage: assets (Vite build)
##############################
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

##############################
# Stage: app (php-fpm)
##############################
FROM php:8.3-fpm-alpine AS app
WORKDIR /var/www/html

RUN apk add --no-cache icu-dev libzip-dev oniguruma-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache \
    && apk del icu-dev libzip-dev oniguruma-dev

COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

##############################
# Stage: nginx (static + reverse proxy)
##############################
FROM nginx:alpine AS nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/html/public /usr/share/nginx/html
