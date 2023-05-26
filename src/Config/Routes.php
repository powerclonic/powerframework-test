<?php

namespace App\Config;

use App\Controllers\HomeController;

use Exception;

class Routes {
    
    private static $web = [
        '/' => [HomeController::class, 'index']
    ];

    private static $api = [];

    public static function web(): array
    {
        if (! isset(self::$web)) throw new Exception("'web' property is missing in Routes");

        return self::$web;
    }    

    public static function api(): array
    {
        if (! isset(self::$api)) throw new Exception("'api' property is missing in Routes");

        return self::$api;
    }
}