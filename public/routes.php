<?php

// define routes

$routes = array(
    array(
        "pattern" => "blog",
        "controller" => "home",
        "action" => "blog"
    ),
    array(
        "pattern" => "home",
        "controller" => "home",
        "action" => "index"
    ),
    array(
        "pattern" => "about",
        "controller" => "home",
        "action" => "about"
    ),
    array(
        "pattern" => "contact",
        "controller" => "home",
        "action" => "contact"
    )
);

// add defined routes
foreach ($routes as $route) {
    $router->addRoute(new Framework\Router\Route\Simple($route));
}

// unset globals
unset($routes);
