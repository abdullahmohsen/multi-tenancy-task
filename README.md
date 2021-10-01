## To Run a Project

<p>First, Install Composer Dependencies<br>
- run composer install</p>
 
<p>Second, Create a copy of your .env file<br>
- run cp .env.example .env</p>

<p>Third, Generate an app encryption key<br>
- run php artisan key:generate</p>

<p>Fourth, Create an empty database for our application</p>

<p>Fifth, In the .env file, add database name in DB_DATABASE to allow the project to connect to the database</p>

<p>Sixth, Migrate the database<br>
- run php artisan migrate --path=database/migrations/landlord --database=landlord</p>
