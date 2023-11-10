cp .env.example .env && COMPOSER_PROCESS_TIMEOUT=2000 composer install && php artisan key:generate --ansi && php artisan db:seed
