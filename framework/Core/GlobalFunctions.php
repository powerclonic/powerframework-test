<?php

use Power\Core\PowerHtmlParser;

function env(string $envName) {
    return $_ENV[$envName];
}

function view(string $view, array $vars = []) {
    $parser = new PowerHtmlParser($vars, $view);

    return $parser->parse();
}