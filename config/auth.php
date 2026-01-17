<?php
return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'moderator' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Visitor guard using temporary_passes provider
        'visitor' => [
            'driver' => 'session',
            'provider' => 'temporary_passes',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'temporary_passes' => [
            'driver' => 'eloquent',
            'model' => App\Models\TemporaryPass::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // Match provider key exactly
        'temporary_passes' => [
            'provider' => 'temporary_passes',
            'table' => 'temporary_pass_password_resets', // make sure you create this table or change as needed
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
