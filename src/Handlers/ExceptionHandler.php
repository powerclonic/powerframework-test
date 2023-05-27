<?php

namespace Power\Handlers;

use Power\Exceptions\NotFoundException;

class ExceptionHandler
{
    public static function generic(\Throwable $error)
    {
        echo $error->getMessage();
        
    }

    public static function notFound(NotFoundException $error)
    {
        echo 'oi';
    }
}
