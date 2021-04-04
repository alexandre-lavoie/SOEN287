FROM php:7.2-fpm

RUN apt-get update -y \
    && apt-get install -y nginx gettext-base

ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN docker-php-ext-install mysqli

RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

COPY ./nginx.conf /etc/nginx.conf.template
COPY ./entrypoint.sh /etc/entrypoint.sh

COPY . /www

RUN ["chmod", "+x", "/etc/entrypoint.sh"]

CMD /bin/bash -c "envsubst '\$PORT' < /etc/nginx.conf.template > /etc/nginx/sites-enabled/default" && /etc/entrypoint.sh