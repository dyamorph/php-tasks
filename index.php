<?php 

include_once "controllers/Controller.php";
include_once "router/Router.php";

define('ROOT', dirname(__FILE__));
require_once (ROOT . '/router/Router.php');

$router = new Router;

$router->run();