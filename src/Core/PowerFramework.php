<?php
  
namespace Power\Core;

use Dotenv\Dotenv;

class PowerFramework
{
    public static function boot()
    {
        require __DIR__ . '/Functions.php';

        $dotenv = Dotenv::createImmutable(rootdir());
        $dotenv->load();
    }
}