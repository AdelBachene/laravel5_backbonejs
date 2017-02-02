# Book Management Assignment
it's a project to insert and manage data using laravel5 and backbonejs

in this project you will have the next pages :
A page that will list the books
A page to add a book
A page to edit an existing book
A route to delete a book
## Getting Started


### Prerequisites
I'm Running this application on nginx and php-fpm so my nginx conf for this is :
`server {
 	listen 80;
 	root   /[Path to your web Folder]/Web/yarakuzen.com/public/;
    include       conf.d/includes/php.conf[any laravel or php config for nginx that you want];
 	server_name local.yarakuzen.com;
 }

set you DB settings and app conf in the .env file, for example :
`
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://local.yarakuzen.com/

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yarakuzen_com
DB_USERNAME=root
DB_PASSWORD=root
`

### Installing Laravel and node packages.
Access your web directory
 - `composer create-project --prefer-dist laravel/laravel laravel5_backbonejs`
Access  laravel5_backbonejs
 - install backbone `npm install backbone --save`
 - install frameworks for frontend `npm install bootstrap jquery --save`
 - install lodash to make ur coding easier `npm install lodash --save`
 - install requirejs `npm install requirejs --save`
 we will use `toastr` to display validation errors.
Make sure that you have public/js folder in your laravel project
next step will be to create a symbolic link node_modules folder to expose it to public (p.s this is not a good practise, a better solution would be to use Elixir for example).
- run this `ln -s node_modules/ public/js/node_modules`
- in this case i'm using mysql as a database, please create a database and add it to your .env file
`DB_DATABASE=yarakuzen_com`
then run this in your terminal to create a migration for the books table
- `php artisan make:migration create_books_table`
open the generated file and replace the content with database/migrations/2017_02_01_101044_create_books_table.php
then run this command
- `php artisan migrate`
