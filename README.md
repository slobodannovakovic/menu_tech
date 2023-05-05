<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Currency Exchange Rate Application

This is a simple currency exchange rate application. You can select to purchase foreign currencies in US dollars.

## Requirements
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/en)
- PHP version 8.1 or latest
- MySql

## Get the app from Github

- Clone the app from [Git Hub](https://github.com/slobodannovakovic/menu_tech).

## Setting .env file

- Duplicate .env.example file and name it .env
- Configure DB settings
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={db_name}
DB_USERNAME=root
DB_PASSWORD=
```

- Configure email settings
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME={your_username}
MAIL_PASSWORD={your_password}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="exchange@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

- Configure queue connection ```QUEUE_CONNECTION=database```

## Database

- Create local database with the same name as specified in .env file

## Installation

- To install PHP dependencies run ```composer install```
- To install JS dependencies run ```npm install```
- To generate app key run ```php artisan key:generate```
- Run migrations ```php artisan migrate```
- Run seeders ```php artisan db:seed```

## Config files

- Configuration for sending emails after order has been created can be found in ```config/order.php``` file.
- Configuration for currencylayer API CAN can be found in ```config/currenylayer.php``` file.

## Tests

- You can run test with ```php artisan test```

## Running the Application

- Setup the front ```npm run dev```
- Setup dev server ```php artisan serve```
- Set up queue worker ```php artisan queue:work```
- In your browser go to ```http://localhost:8000/```

## Get exchange rates from external API

This will fire background job which will go to the external API, fetch currency exchange rates and save them to local database.

- Fire up scheduler ```php artisan schedule:run```
- To keep the schedule worker running ```php artisan schedule:work```
