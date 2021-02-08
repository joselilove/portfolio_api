FROM php:7.3-apache

RUN apt-get update \
  && apt-get install -y git libcurl4-gnutls-dev zlib1g-dev libicu-dev g++ libxml2-dev libpq-dev unzip \
  && git clone -b 5.1.1 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
  && docker-php-ext-install mysqli pdo pdo_mysql intl opcache redis \
  && apt-get -y autoremove \
  && apt-get -y autoclean \
  && rm -rf /var/lib/apt/lists/* \
  && a2enmod rewrite

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1

WORKDIR /tmp
COPY ./composer.json /tmp/
COPY ./composer.lock /tmp/

RUN curl -L https://getcomposer.org/installer | php \
  && /tmp/composer.phar config -g repositories.packagist composer http://packagist.jp \
  && /tmp/composer.phar config -g secure-http false \
  && /tmp/composer.phar --no-scripts --no-autoloader --no-dev install

COPY . /www
WORKDIR /www

RUN ln -s /tmp/vendor /www/vendor

COPY docker/apache/apache2.conf /etc/apache2/apache2.conf
COPY docker/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/health-check.php /www/public/health-check.php

EXPOSE 80
