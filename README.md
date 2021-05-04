# lakes-slice-admin

## Installation

``` bash
# clone the repo
$ git clone https://github.com/Allanez/lakes-slice-admin

# go into app's directory
$ cd lakes-slice-admin/laravel

# install app's dependencies
$ composer install

# install app's dependencies
$ npm install

Usage

# serve with hot reload at localhost:8080
npm run serve

# build for production with minification
npm run build

# run linter
npm run lint

# run unit tests
npm run test:unit

# run e2e tests
npm run test:e2e

If you choose MySQL

    Install MySQL
    Create database (this way or another)

$ mysql -uroot -p
mysql> create database laravel;

Create a user with privileges to the laravel database (root user may not work while it requires a sudo)

    Update .env file Copy file ".env.example", and change its name to ".env". Then in file ".env" complete database configuration:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

Next step

# in your app directory
# generate laravel APP_KEY
$ php artisan key:generate

# generate jwt secret
$ php artisan jwt:secret

# run database migration and seed
$ php artisan migrate:refresh --seed

# go to coreui directory
$ cd ../coreui

# install app's dependencies
$ npm install


If you need separate backend and frontend

# back to laravel directory
$ cd ../laravel

# start local server
$ php artisan serve

$ cd ../coreui

$ npm run serve

Open your browser with address: localhost:8080
