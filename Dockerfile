FROM php:8.3.20-apache

RUN apt update && apt install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    curl \
    zip \
    unzip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

COPY .docker/apache/default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["sh", ".docker/entrypoint.sh"]