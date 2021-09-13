# Bitchest
This repo contains a laravel project which allows buying and sell currencies

You can find the database model [here](BDD_Bitchest.png)

The backend part is implemented in Laravel 8.x, the apis documentation is [here](apidoc.yaml) and the frontend part in implemented in Vue2

# Requires

    php 7.4.^
    composer version 2.0.14 or later
    npm

# Getting started
## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/adiongue/bitchest.git

Switch to the repo folder

    cd bitchest

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate:refresh --seed

Start the local development server

    php artisan serve
    npm run watch

You can now access the server at http://localhost:8000
