<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Getting started

# laravel-blog-with-sqlite
Demo Project Laravel Blog

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/6.0/installation#installation)


Clone the repository

    git clone git@gitlab.com:rodineiti/laravel-blog-with-sqlite.git

Switch to the repo folder

    cd laravel-blog-with-sqlite

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Set Database SQLITE in .env

    DB_CONNECTION=sqlite

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

![image](https://user-images.githubusercontent.com/25492122/94281225-c0656f00-ff24-11ea-9d5d-bedf292d5bb0.png)

![image](https://user-images.githubusercontent.com/25492122/94281319-dbd07a00-ff24-11ea-907f-4c20148c92c4.png)