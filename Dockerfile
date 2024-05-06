FROM php:8.3-fpm

# set your user name, ex: user=carlos
ARG user=saladdinha
ARG uid=1000

WORKDIR /var/www/

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx/nginx.conf /etc/nginx/nginx.con

# Linux Library
RUN apt-get update -y && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    postgresql \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP Extension
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN composer install --ignore-platform-reqs --prefer-dist --no-scripts \
    --no-progress --no-suggest --no-interaction --no-dev --no-autoloader

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

CMD sh ./docker/startup.sh