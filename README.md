## To Run a Project

[First], Install Composer Dependencies
- run composer install
[Second], Create a copy of your .env file
- run cp .env.example .env
[Third], Generate an app encryption key
- run php artisan key:generate
[Fourth], Create an empty database for our application
[Fifth], In the .env file, add database name in DB_DATABASE to allow the project to connect to the database
[Sixth], Migrate the database
- run php artisan migrate --path=database/migrations/landlord --database=landlord
