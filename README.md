<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h4> How to Install / Run This Application </h4>
<ol>
    <li> Open Terminal, and then execute composer install </li>
    <li> execute npm i </>
    <li> After download vendor and all necessary component, copy .env.example and make rename as .env </li>
    <li> execute php artisan key:generate --ansi </li>
    <li> Change Env Value Especially on database section, customize with your configuration 
        DB_CONNECTION=
        DB_HOST=
        DB_PORT=
        DB_DATABASE=
        DB_USERNAME=root
        DB_PASSWORD=
    </li>
    <li> execute php artisan migrate:refresh --seed to migrate all table and seeding database </li>
    <li> execute npm run dev </li>
    <li> execute php artisan serve </li>
<ol>

<h4> Credential User Form Demo </h4>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>admin@student.id</td>
            <td>Faker Name</td>
        </tr>
    </tbody>
</table>

