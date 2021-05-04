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
```
### If you choose SQLite

``` bash
# create database
$ touch database/database.sqlite
```
Copy file ".env.example", and change its name to ".env".
Then in file ".env" replace this database configuration:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=laravel
* DB_USERNAME=root
* DB_PASSWORD=

To this:

```
DB_CONNECTION=sqlite
DB_DATABASE=/path_to_your_project/database/database.sqlite
```

### If you choose PostgreSQL

1. Install PostgreSQL

2. Create user
``` bash
$ sudo -u postgres createuser --interactive
enter name of role to add: laravel
shall the new role be a superuser (y/n) n
shall the new role be allowed to create database (y/n) n
shall the new role be allowed to create more new roles (y/n) n
```
3. Set user password
``` bash
$ sudo -u postgres psql
postgres= ALTER USER laravel WITH ENCRYPTED PASSWORD 'password';
postgres= \q
```
4. Create database
``` bash
$ sudo -u postgres createdb laravel
```
5. Copy file ".env.example", and change its name to ".env".
Then in file ".env" replace this database configuration:

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=laravel
* DB_USERNAME=root
* DB_PASSWORD=

To this:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=password
```

### If you choose MySQL

1. Install MySQL
2. Create database (this way or another)
``` bash
$ mysql -uroot -p
mysql> create database laravel;
```
Create a user with privileges to the laravel database (root user may not work while it requires a sudo)

3. Update .env file
Copy file ".env.example", and change its name to ".env".
Then in file ".env" complete database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Next step

``` bash
# in your app directory
# generate laravel APP_KEY
$ php artisan key:generate

# generate jwt secret
$ php artisan jwt:secret

# run database migration and seed
$ php artisan migrate:refresh --seed

```

```bash
# go to coreui directory
$ cd ../coreui

# install app's dependencies
$ npm install
```

## Usage

### Test
``` bash
# test
$ php vendor/bin/phpunit
```

### If you need separate backend and frontend

``` bash
# back to laravel directory
$ cd ../laravel

# start local server
$ php artisan serve

$ cd ../coreui

$ npm run serve
```
Open your browser with address: [localhost:8080](localhost:8080)

If you need change backend adress go to file /coreui/src/main.js
And change line:
```js
Vue.prototype.$apiAdress = 'http://127.0.0.1:8000'
```

### If you don't need separate backend and frontend

1. Go to file /laravel/routes/web.php
And uncomment this lines:
```php
Route::get('/{any}', function () {
    return view('coreui.homepage');
})->where('any', '.*');
```
2. Go to file /laravel/config/filesystems.php
And change this line:
```php
'root' => public_path() . '/../../coreui/public/public',
```
To this:
```php
'root' => public_path('public'),
```
3. Go to file /coreui/src/views/media/Media.vue
And change this line:
```js
changePort: 'localhost:8080',
```
To this:
```js
changePort: 'localhost:8000',
```
4. 
``` bash
# back to laravel directory
$ cd ../laravel

# generate mixing
$ npm run dev

# and repeat generate mixing
$ npm run dev

# start local server
$ php artisan serve
```
Open your browser with address: [localhost:8000](localhost:8000) 
