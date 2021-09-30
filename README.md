## To Run a Project

<p>First, Install Composer Dependencies</p>
- run composer install
<p>Second, Create a copy of your .env file</p>
- run cp .env.example .env
<p>Third, Generate an app encryption key</p>
- run php artisan key:generate
<p>Fourth, Create an empty database for our application</p>
<p>Fifth, In the .env file, add database name in DB_DATABASE to allow the project to connect to the database</p>
<p>Sixth, Migrate the database</p>
- run php artisan migrate --path=database/migrations/landlord --database=landlord
