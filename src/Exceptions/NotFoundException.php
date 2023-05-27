<?php

namespace Power\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct($message = "Page not found", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
