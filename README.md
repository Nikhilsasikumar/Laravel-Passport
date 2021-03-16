
## Laravel-Passport

### Install Passport via the Composer package manager

composer require laravel/passport

### migrate  database 

php artisan migrate

Passport's service provider registers its own database migration directory, so you should migrate your database after installing the package. The Passport migrations will create the tables your application needs to store OAuth2 clients and access tokens:
