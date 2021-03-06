
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

### Call the Passport::routes method

call the Passport::routes method within the boot method of your App\Providers\AuthServiceProvider. This method will register the routes necessary to issue access tokens and revoke access tokens, clients, and personal access tokens:

use Laravel\Passport\Passport;
Passport::routes();

### api authentication guard to passport
in your application's config/auth.php configuration file, you should set the driver option of the api authentication guard to passport. This will instruct your application to use Passport's TokenGuard when authenticating incoming API requests:

 'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],