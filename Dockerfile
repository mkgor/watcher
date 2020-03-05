FROM php:7.3-fpm

RUN buildDeps="libpq-dev libzip-dev libldap2-dev wget zip unzip libaio1 libicu-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libmagickwand-6.q16-dev" && \
    apt-get update && \
    apt-get install -y $buildDeps --no-install-recommends && \
        docker-php-ext-install \
            opcache \
            pdo \
            sockets \
            intl \
            bcmath \
            pdo_mysql \
            gd \
            zip

RUN cd /tmp && curl -sS https://getcomposer.org/installer -o composer-setup.php && \
	php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Clean up
RUN rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/*

CMD ["php-fpm"]