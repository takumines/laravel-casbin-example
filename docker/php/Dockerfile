FROM dunglas/frankenphp:php8.4-bookworm

ARG APP_ENV=local

ENV TZ=UTC \
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    libnss3-tools \
    unzip \
    locales \
    libcurl4-openssl-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*  \
  && locale-gen en_US.UTF-8 \
  && localedef -f UTF-8 -i en_US en_US.UTF-8 \
  && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
    bcmath \
    mbstring \
  && composer config -g process-timeout 3600  \
  && composer config -g repos.packagist composer https://packagist.org

COPY ./docker/php/php.local.ini /usr/local/etc/php/php.ini

