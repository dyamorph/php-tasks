<?php 
declare(strict_types=1);

// use \Router\Router;
spl_autoload_register(function(string $class) {
    $path = __DIR__ . "/controllers/{$class}.php";
    if (file_exists($path)) {
        include $path;
    }
});
spl_autoload_register(function(string $class) {
    $path = __DIR__ . "/core/{$class}.php";
    if (file_exists($path)) {
        include $path;
    } 
});

define('ROOT', dirname(__FILE__));
include ROOT . '/router/Router.php';

$router = new Router;

$router->run();