# Employees Task Manager

## Getting started:
1. Install Composer Dependencies
```run composer install```
1. Create a copy of your .env file
```run cp .env.example .env```
1. Generate an app encryption key
```run php artisan key:generate```
1. Create an empty database for our application
1. In the .env file, add database name in **DB_DATABASE** to allow the project to connect to the database
1. Migrate the database
```run php artisan migrate --path=database/migrations/landlord --database=landlord```
