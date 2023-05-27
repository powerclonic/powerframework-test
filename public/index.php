<?php

use Power\Core\PowerFramework;
use Power\Exceptions\NotFoundException;
use Power\Handlers\ExceptionHandler;
use Power\Handlers\RequestHandler;
use Power\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$frameworkInstance = new PowerFramework();

$frameworkInstance->boot();

try {
    new RequestHandler(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/', new Request($_REQUEST));
} catch (NotFoundException $error) {
    ExceptionHandler::notFound($error);
} catch (\Throwable $error) {
    ExceptionHandler::generic($error);
}