Deploy.

1. composer install
2. php artisan key:generate
3. Create database 'exyplis'.
4. php artisan migrate:fresh.
5. php artisan serve.

.env file database settings

sudo chmod 775 bootstrap/cache

sudo chmod 775 storage

sudo chgrp -R www-data storage bootstrap/cache
