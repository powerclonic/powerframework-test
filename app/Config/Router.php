<?php

use App\Controllers\HomeController;

$config = [

    'web_routes' => [
        '/' => [HomeController::class, 'index']
    ],

    'api_routes' => [
        '/' => []
    ],

    'api_prefix' => '/api',
];
