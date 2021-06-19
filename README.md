rename .env.example to .env (mail credentials already placed for user email verification)
create database and update credentials in env file
then run these commands in sequence

composer update <br>
php artisan migrate <br>
php artisan passport:install <br>
php artisan key:generate <br>

use virtual host to run the project ( strictly )
