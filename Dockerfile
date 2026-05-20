FROM composer:latest AS composer

FROM php:8.5-fpm

RUN apt-get update && apt-get install -y \
	git curl zip unzip libpng-dev libonig-dev libxml2-dev \
	libzip-dev libicu-dev libpq-dev nodejs npm \
	&& docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl gd intl \
	&& apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

RUN php artisan config:clear

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]