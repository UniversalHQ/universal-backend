FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
        libpng-dev libmcrypt-dev libmagickwand-dev vim cron supervisor \
        curl libzip-dev unzip git ghostscript software-properties-common \
        --no-install-recommends \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions gd imagick intl pdo_mysql redis zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY x_infrastructure/docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www

# Install dependencies
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer

# Copy codebase
COPY . ./

# Finish composer
RUN composer dump-autoload --no-scripts --no-dev --optimize

# set the user for the container and alow to modify the storage files
RUN chown -R www-data:www-data /var/www /var/www/storage

# Set up the scheduler for Laravel.
COPY x_infrastructure/docker/app/laravel-scheduler /etc/cron.d/
RUN chmod 0644 /etc/cron.d/laravel-scheduler

# Copy the start script.
COPY x_infrastructure/docker/app/docker-entrypoint.sh /usr/local/bin/

ENTRYPOINT ["docker-entrypoint.sh"]

# Start the service.
CMD ["supervisord","-c","/var/www/x_infrastructure/docker/app/supervisor/service_script.conf"]
