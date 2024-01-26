# Nikko Brewing

### A craft beer brewery in Senjogahara of Okunikko which opened in April 2018. 

## E-commerce Web App

### Developed by : 
Hans Patrick Eko Prasetyo

## Project setup
```
composer install
```

### Create enviroment file
```
cp .env.example .env
```

### Generate Unique Application Key
```
php artisan key:generate
```

### Run PHP built-in
```
php artisan serve
```

## Installation and Database Import Steps

### Prerequisites
- Ensure that you have installed and configured a web server (such as Apache or Nginx).
- Make sure PHP and MySQL or MariaDB are installed on your system.
- Ensure you have access to phpMyAdmin.

### Access phpMyAdmin
Open a web browser and navigate to the phpMyAdmin URL (usually accessible at http://localhost/phpmyadmin).

### Login to phpMyAdmin
Enter your phpMyAdmin username and password.

### Create a New Database
- Click on the "Database" tab.
- Enter the name 'nikko' for the new database.
- Choose the appropriate collation settings.

### Import the Database
- Select the newly created database in the left panel.
- Click on the "Import" tab at the top.
- Choose the SQL file to be imported.
- Configure additional settings if necessary (e.g., character set, collation).
- Click the "Go" button to start the import process.

### Verify Database Import
- Check the phpMyAdmin interface for any error messages during the import process.
- Verify that the tables and data from the SQL file are now present in your database.
- Once the import process is complete, your database is ready for use.

### Customize configuration
See [Configuration Reference](https://laravel-news.com/creating-configuration-in-laravel).

## Tools, Library, and Framework

### Programming Language

- [PHP](https://www.php.net/)
  <br>
  PHP is a general-purpose scripting language geared towards web development.
- [JavaScript](https://www.w3schools.com/js/)
  <br>
  JavaScript is a scripting or programming language that allows you to implement complex features on web pages

### DBMS

- [MySQL](https://www.mysql.com/)
  <br>
  MySQL is a relational database management system based on SQL. MySQL is developed, distributed, and supported by Oracle Corporation.

### Framework and Library

- [Bootstrap](https://getbootstrap.com/)
  <br>
  Bootstrap is the most popular CSS Framework for developing responsive websites.
- [Laravel](https://laravel.com/)
  <br>
  Laravel is a web application framework with expressive, elegant syntax.
  
## Database Installation
