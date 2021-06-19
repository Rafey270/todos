rename .env.example to .env (mail credentials already placed for user email verification)
create database and update credentials in env file
then run these commands in sequence

composer update
php artisan migrate
php artisan passport:install
php artisan key:generate

use virtual host to run the project ( strictly )
