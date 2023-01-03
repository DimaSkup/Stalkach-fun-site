# THIS IS A REPOSITORY OF THE FAN WEBSITE ABOUT S.T.A.L.K.E.R. 2

## Installation and setting up
#### Download the project
    $ git clone https://github.com/x-oscarr/stalker2.ru.git
    $ cd stalker2.ru
    
#### Pull the last changes    
    $ git checkout master
    $ git pull origin dev
    $ git checkout dev
    
#### Installing the dependencies using composer 
* Installing composer packages: `$ composer install`

#### Setting .env  
* Run `$ cp .env.example .env` or `$ copy .env.example .env`
* Inside the `.env` file set the parameter `DB_USERNAME` and `DB_PASSWORD` with your own to have an access to the database


#### Set up the project
* Create a database with name is equal to `DB_DATABASE` parameter inside .env file.
* Run `$ php artisan key:generate`  
* Run `$ php artisan migrate`
* Run `$ php artisan db:seed`

## Run the project
* Run `php artisan serve`
* Go to link `localhost:8000`

## To upgrage your laravel project from v7.0 to v8.0:
* Run `git pull origin dev`
* Run `rm -rf vendor/*`
* Run `composer install`
For additional information read https://laravel.com/docs/8.x/upgrade

## To pull last changes from dev
* Run `git pull origin dev`
* Run `composer dump-autoload`
* Run `php artisan cache:clear`
* Run `php artisan migrate:refresh --seed`
