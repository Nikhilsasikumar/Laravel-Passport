
## Laravel-Passport

### Install Passport via the Composer package manager

composer require laravel/passport

### migrate  database 

Passport's service provider registers its own database migration directory, so you should migrate your database after installing the package. The Passport migrations will create the tables your application needs to store OAuth2 clients and access tokens:

php artisan migrate



### Execute the passport:install Artisan command

This command will create the encryption keys needed to generate secure access tokens. In addition, the command will create "personal access" and "password grant" clients which will be used to generate access tokens:

php artisan passport:install

### Add the Laravel\Passport\HasApiTokens
add the Laravel\Passport\HasApiTokens trait to your App\Models\User model. This trait will provide a few helper methods to your model which allow you to inspect the authenticated user's token and scopes:

use Laravel\Passport\HasApiTokens;
use HasApiTokens
