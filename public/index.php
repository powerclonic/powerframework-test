<?php

use Power\Core\Handlers\RequestHandler;
use Power\Core\Power;

require __DIR__ . '/../vendor/autoload.php';

$frameworkInstance = new Power();
$frameworkInstance->boot();

$route = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

RequestHandler::handle($route, $_REQUEST);