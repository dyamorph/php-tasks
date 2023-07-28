<?php

declare(strict_types=1);

require "vendor/autoload.php";

use router\Router;

session_start();

$router = new Router();

$router->run();
