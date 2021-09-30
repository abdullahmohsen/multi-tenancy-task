## To Run a Project

<p>First, Install Composer Dependencies</p>
<p>- run composer install</p>
<p>Second, Create a copy of your .env file</p>
<p>- run cp .env.example .env</p>
<p>Third, Generate an app encryption key</p>
<p>- run php artisan key:generate</p>
<p>Fourth, Create an empty database for our application</p>
<p>Fifth, In the .env file, add database name in DB_DATABASE to allow the project to connect to the database</p>
<p>Sixth, Migrate the database</p>
<p>- run php artisan migrate --path=database/migrations/landlord --database=landlord</p>
