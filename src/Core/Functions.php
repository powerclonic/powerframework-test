<?php

use Power\Core\PowerParser;

function rootdir() {
    return __DIR__ . '/../../';
}

function appdir() {
    return rootdir() . 'app/';
}

function srcdir() {
    return rootdir() . 'src/';
}

function config(string $configName){
    $configName = strtolower($configName);
    $configName = ucfirst($configName);
    
    require appdir() . 'Config/' . $configName . '.php';

    return $config;
}

function router() {
    $router = config('ROUTER');

    $apiRoutesWithPrefix = array_map(function($key) use ($router) {
        return $router['api_prefix'] . $key;
    }, array_keys($router['api_routes']));
    
    $router['api_routes'] = array_combine($apiRoutesWithPrefix, $router['api_routes']);

    $router['routes'] = array_merge($router['api_routes'], $router['web_routes']);
    
    return (object) $router;
}

function view(string $viewName) {
    $parser = new PowerParser($viewName);
}