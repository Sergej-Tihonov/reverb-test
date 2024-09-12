ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

USER root

# Install general packages
RUN apt-get update -yqq \
 && apt-get install -yqq \
    zip \
    unzip \
    curl \
    git \
    nano \
    sudo

# Install laravel necessary packages
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath redis xdebug gd exif zip sockets pcntl

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install nodejs & npm
RUN apt-get update -yqq \
 && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs \
 && npm install -g npm@latest

# Setup docker user to prevent right and access conflicts
RUN groupadd -g 1000 docker \
 && useradd -p $(openssl passwd -1 docker) -l -u 1000 -g docker -m docker \
 && usermod -aG sudo docker \
 && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Change timezone to Europe/Berlin
RUN cp /etc/localtime /etc/localtime.backup \
 && ln -sf /usr/share/zoneinfo/Europe/Berlin /etc/localtime

# Clean up
RUN apt-get clean \
 && apt-get autoremove \
 && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set the default user
USER docker
