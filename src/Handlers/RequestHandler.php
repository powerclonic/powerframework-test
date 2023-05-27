<?php

namespace Power\Handlers;

use Power\Http\Request;

class RequestHandler
{
    private string $route;
    private Request $request;

    public function __construct(string $route, Request $request)
    {
        $this->route = $route;
        $this->request = $request;

        $this->handle();
    }

    private function handle()
    {
        if (!$this->routeExists()) {
            throw new \Exception("Route not found!");
        }
        
        $routeConfig = router()->routes[$this->route];
        
        $routeControllerInstance = new $routeConfig[0]();
        
        if (!method_exists($routeControllerInstance, $routeConfig[1])) {
            throw new \Exception("Method '{$routeConfig[1]}' does not exist in class '{$routeConfig[0]}'");
        }
        
        call_user_func([$routeControllerInstance, $routeConfig[1]]);
    }

    private function routeExists(): bool
    {
        return key_exists($this->route, router()->routes);
    }
}
