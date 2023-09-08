FROM php:8.2-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apt-get update && apt-get install -y \
 git \
 curl \
 libpng-dev \
 libonig-dev \
 libxml2-dev \
 libpq-dev \
 zip \
 unzip

RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo_mysql  pdo_pgsql pgsql mbstring exif pcntl bcmath gd


RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer \

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY docker-entrypoint.sh /web/docker-entrypoint.sh

RUN chmod +x /web/docker-entrypoint.sh

CMD php-fpm

EXPOSE 9000
ENTRYPOINT ["/web/docker-entrypoint.sh"]
