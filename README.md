# seci5-56472-copystudent

Welcome to the project created by Nasser Abattouy for the SECI5 course, under the number 56472. This project is based on the Laravel framework and uses the Laragon local development environment to facilitate development and testing.

## Prerequisites

Before you start, make sure you have the following installed on your system:

- Laragon (version 6.0)
- Composer (version 2.5.5)
- Node.js (version 18.16.0)
- PHP (version 8.2.4)
- MySQL (version 8.0.30)

## Installation

Clone this repository in the `C:\laragon\www` directory (or the location of your "www" Laragon folder):

``bash
git clone https://git.esi-bru.be/56472/seci5-56472-copystudent.git "C:\laragon\www\copystudent"

##Access the project directory:

cd "C:\laragon\www\copystudent"

##Install the PHP dependencies using Composer:
composer install

##Install the JavaScript dependencies using npm (or yarn) :
npm install

##Copy the environment file :
copy .env.example .env

##Generate the application key :
php artisan key:generate

##Execute the migrations to create the database tables:
php artisan migrate

##Use
##To access the application, open your web browser and enter the following URL:
https://copystudent.test/

