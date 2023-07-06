<?php

declare(strict_types=1);

spl_autoload_register(function (string $class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . "/$class.php";
    if (file_exists($path)) {
        require_once($path);
    }
});

use router\Router;

$router = new Router();

$router->run();
