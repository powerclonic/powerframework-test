<?php

namespace Power\Core;

use Dotenv\Dotenv;

class Power
{
    public static function boot()
    {
        require __DIR__ . '/GlobalFunctions.php';

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();
    }
}
