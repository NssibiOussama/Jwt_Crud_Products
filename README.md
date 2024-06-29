<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


Laravel 9 Project
Running the Project
Start the Server: php artisan serve

This command will start a development server.

Fetch Products Using DataTables
To fetch products with pagination using DataTables, make a GET request to the following endpoint ( update http://127.0.0.1:8000 with your local domain.):

http://127.0.0.1:8000/api/products/data?start=10&length=15
start: Start index for pagination.
length: Number of items to fetch per page.
Replace start and length with your desired values.

Accessing Swagger Docs:
Documentation for API endpoints is available via Swagger at:

http://127.0.0.1:8000/api/documentation ( update http://127.0.0.1:8000 with your local domain. )

