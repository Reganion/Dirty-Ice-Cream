<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'), // This will default to 'web' guard
        'passwords' => env('AUTH_PASSWORD_BROKER', 'customers'), // Default password reset broker
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'customers', // This references the 'customers' provider
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // This references the 'admins' provider
        ],
    ],

    'providers' => [
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class, // Assuming you have a Customer model
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, // Assuming you have an Admin model
        ],
    ],

    'passwords' => [
        'customers' => [
            'provider' => 'customers',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800), // Default timeout for password reset links

];
