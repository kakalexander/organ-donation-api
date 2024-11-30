<?php

return [

    // Configurações existentes...

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

    /*
    |--------------------------------------------------------------------------
    | Custom Authentication Routes
    |--------------------------------------------------------------------------
    |
    | These routes define the login and registration endpoints, including
    | their HTTP methods, URIs, controllers, and actions.
    |
    */

    'custom_routes' => [
        'login' => [
            'method' => 'POST',
            'uri' => '/login',
            'controller' => \App\Http\Controllers\Auth\AuthController::class,
            'action' => 'login',
        ],
        'register' => [
            'method' => 'POST',
            'uri' => '/register',
            'controller' => \App\Http\Controllers\Auth\AuthController::class,
            'action' => 'register',
        ],
    ],

    'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
],
];
