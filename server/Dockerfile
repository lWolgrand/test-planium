FROM php:7.4-fpm

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN apt-get update && apt-get install -y \
    vim \
    git \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
 
COPY composer*.json ./

COPY setup.sh ./

RUN chmod +x setup.sh

RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www

ENTRYPOINT ["bash", "setup.sh" ]





