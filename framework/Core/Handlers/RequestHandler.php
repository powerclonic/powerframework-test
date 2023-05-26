<?php

namespace Power\Core\Handlers;

use App\Config\Routes;
use Power\Core\Handlers\ExceptionHandler;

class RequestHandler {
    public static function handle(string $path)
    {
        if (substr($path, 0, 4) === '/api') {
            return self::apiRequest($path);
        } else {
            return self::webRequest($path);
        };
    }

    private static function apiRequest($path)
    {
        $routes = Routes::api();
        
        try {
            if (key_exists($path, $routes)) {
                $routeProperties = $routes[$path];
                $controllerInstance = new $routeProperties[0]();
        
                if (! method_exists($routeProperties[0], $routeProperties[1])) throw new \Exception("Method '{$routeProperties[1]}' does not exist in class '{$routeProperties[0]}'");
        
                require call_user_func(array($controllerInstance, $routeProperties[1]));
            }
        } catch (\Throwable $error) {
            ExceptionHandler::handle($error);
        }
    }

    private static function webRequest($path)
    {
        $routes = Routes::web();
        
        try {
            if (key_exists($path, $routes)) {
                $routeProperties = $routes[$path];
                $controllerInstance = new $routeProperties[0]();
        
                if (! method_exists($routeProperties[0], $routeProperties[1])) throw new \Exception("Method '{$routeProperties[1]}' does not exist in class '{$routeProperties[0]}'");
        
                require call_user_func(array($controllerInstance, $routeProperties[1]));
            }
        } catch (\Throwable $error) {
            ExceptionHandler::handle($error);
        }
    }
}