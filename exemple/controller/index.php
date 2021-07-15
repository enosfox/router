<?php

require dirname(__DIR__, 2) . "/vendor/autoload.php";
require __DIR__ . "/Test/Kitsune.php";
require __DIR__ . "/Test/Name.php";

use KitsuneCode\Router\Router;

define("BASE", "https://www.localhost/kitsunecode/router/exemple/controller");
$router = new Router(BASE);

/**
 * routes
 */
$router->namespace("Test");

$router->get("/", "Kitsune:home");
$router->get("/edit/{id}", "Kitsune:edit");
$router->post("/edit/{id}", "Kitsune:edit");

/**
 * group by routes and namespace
 */
$router->group("admin");

$router->get("/", "Kitsune:admin");
$router->get("/user/{id}", "Kitsune:admin");
$router->get("/user/{id}/profile", "Kitsune:admin");
$router->get("/user/{id}/profile/{photo}", "Kitsune:admin");

/**
 * named routes
 */
$router->group("name");
$router->get("/", "Name:home", "name.home");
$router->get("/hello", "Name:hello", "name.hello");

$router->get("/redirect", "Name:redirect", "name.redirect");
$router->get("/redirect/{category}/{page}", "Name:redirect", "name.redirect");
$router->get("/params/{category}/page/{page}", "Name:params", "name.params");

/**
 * Group Error
 */
$router->group("error")->namespace("Test");
$router->get("/{errcode}", "Kitsune:notFound");

/**
 * execute
 */
$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
    //router->redirect("/error/{$router->error()}");
}