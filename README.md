Setup Guide
============

Git clone this repo.

create .env file in root directory
configure database setting

run 'php artisan key:generate' if APP_KEY is empty.

create empty "kaungsan" database in phpMyAdmin.

run 'npm install' and 'npm run dev' to install node dependencies.

run 'php artisan migrate' to build database tables according to migrations.

run 'php artisan serve' to run the application.

Go to https://localhost:8000/register to create a new account.

<b>TODO</b>
<ul>
    <li>Implement Repository Design Pattern</li>
    <li>Update Name Search into combination search(Customer Name + Material Name) </li>
    <li>Invoice function</li>
    <li>Print button, export buttons</li>
</ul>