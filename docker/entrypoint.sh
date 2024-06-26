#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
    case "$APP_ENV" in
    "local")
        echo "Copying .env.example ... "
        cp .env.example .env
    ;;
    "prod")
        echo "Copying .env.prod ... "
        cp .env.prod .env
    ;;
    esac
else
    echo "env file exists."
fi

##change crsf token
rm ../vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php
cp ../VerifyCsrfToken.php ../vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/

# php artisan migrate
php artisan clear
php artisan optimize:clear
php artisan breeze:install

npm install --save-dev vite laravel-vite-plugin
npm install --save-dev @vitejs/plugin-vue

npm run build

# Fix files ownership.
chown -R www-data .
chown -R www-data /var/www/storage
chown -R www-data /var/www/storage/logs
chown -R www-data /var/www/storage/framework
chown -R www-data /var/www/storage/framework/sessions
chown -R www-data /var/www/bootstrap
chown -R www-data /var/www/bootstrap/cache

# Set correct permission.
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/storage/logs
chmod -R 775 /var/www/storage/framework
chmod -R 775 /var/www/storage/framework/sessions
chmod -R 775 /var/www/bootstrap
chmod -R 775 /var/www/bootstrap/cache

php-fpm -D
nginx -g "daemon off;"
