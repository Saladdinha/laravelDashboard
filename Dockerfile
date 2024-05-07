# Used for prod build.
FROM 992382370408.dkr.ecr.us-east-2.amazonaws.com/prod-laravel-api:latest as php

# Copy configuration files.
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# Set working directory to ...
WORKDIR /var/www/

# Copy files from current folder to container current folder (set in workdir).
COPY --chown=www-data:www-data . .

# Create laravel caching folders.
RUN mkdir -p ./storage/framework
RUN mkdir -p ./storage/framework/{cache, testing, sessions, views}
RUN mkdir -p ./storage/framework/bootstrap
RUN mkdir -p ./storage/framework/bootstrap/cache

# Adjust user permission & group.
RUN usermod --uid 1000 www-data
RUN groupmod --gid 1000  www-data

RUN chmod 775 docker/
RUN chmod 775 ./docker/entrypoint.sh

RUN apt-get install -y npm

# Run the entrypoint file
ENTRYPOINT [ "docker/entrypoint.sh" ]