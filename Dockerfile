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

RUN echo "upload_max_filesize=50M" > /usr/local/etc/php/conf.d/uploads.ini \
 && echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/uploads.ini
 
RUN echo "<Directory /var/www/html>" > /etc/apache2/conf-available/upload-limit.conf \
 && echo "    LimitRequestBody 104857600" >> /etc/apache2/conf-available/upload-limit.conf \
 && echo "</Directory>" >> /etc/apache2/conf-available/upload-limit.conf \
 && a2enconf upload-limit

RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["sh", ".docker/entrypoint.sh"]