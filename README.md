# Employees Task Manager

## Getting started:
1. Fork this Repository
1. Change the current directory to project path
   ex: ```cd multi-tenancy-task ```
1. make the database folder ```mkdir mysql```
1. ``` docker-compose build && docker-compose up -d ```

    **alert:** </span> if there is a server running in your machine, you should stop it or change port 80 in docker-compose.yml to another port(8000)

1. install dependencies with composer ```cd src && composer install```, if you are in a production server and composer isn't installed, you can install the dependencies from docker environment ``` docker-compose exec php /bin/sh``` then, ```composer install```
1. run ``` cp .env.example .env ```
1. run ``` php artisan key:generate ```   
1. run ``` docker-compose exec php php /var/www/html/artisan migrate --path=database/migrations/landlord --database=landlord```


**Info:** if you want only the Laravel project,
copy the  **/src** folder to wherever you want and make database with name **tenancy** , then run
```composer install```, ```cp .env.example .env```, ```php artisan key:generate```, ```php artisan migrate --path=database/migrations/landlord --database=landlord```, then ``` php artisan serve ```

