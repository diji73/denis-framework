<?php declare(strict_types = 1);

return [
    'driver'   => env('DB_DRIVER', 'mysql'),
    'host'     => env('DB_HOST', 'localhost'),
    'name'     => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
];
