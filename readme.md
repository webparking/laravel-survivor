# Laravel Survivor

This library solves the problem if you have a site open and the you're gone from your device for some time. In this case the CSRF token used on your forms expires, and you get an Exception.

The purpose of this library is to keep the session from expiring, but also to keep the tokens up to date throughout your application.

## Installation (Laravel 5.2 is required)

1. Install via composer

    composer require influendo/laravel-survivor

2. Add the script to your view. You can also add it to your footer.blade.php partial or your main layout file (by your own preference):

    {!! survivor() !!}

## Laravel 5.4 or older

If you're running Laravel 5.4 or older, you need to manually register the service provider.
So just add the service provider to your **config\app.php** file:

    Influendo\LaravelSurvivor\SurvivorServiceProvider::class,

## Configuration

To configure the library you just need to publish the default vendor configuration:

    php artisan vendor:publish --tag=survivor

You can change the interval in miliseconds, the path for ping route and the query selector for input elements which will be updated when a token expires.

## Funcionality

First of all the library pings a custom created endpoint in a predefined interval to keep your session up to date.
When the CSRF token expires, the endpoint returns a new token, and the script then updates all the input fields named **"_token"** and a meta tag named **"csrf-token"**.

If your using any 3rd party scripts, you can fetch the valid token at any time from the **window.LaravelSurvivor.token** object.
