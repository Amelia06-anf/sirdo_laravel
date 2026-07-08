<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'petugas',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],
    'providers' => [
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],
    ],
    'passwords' => [
        'petugas' => [
            'provider' => 'petugas',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
    'password_timeout' => 10800,
];
