<?php

declare(strict_types=1);

namespace router;

use controllers\AppController;
use controllers\UserController;

class Router
{
    private array $routes;

    public function __construct()
    {
        $routesPath = __DIR__ . '/../routes/web.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
    }

    private function getMETHOD()
    {
        if (!empty($_SERVER['REQUEST_METHOD'])) {
            return $_SERVER['REQUEST_METHOD'];
        }
    }

    public function run(): void
    {
        $uri = $this->getURI();
        $method = $this->getMETHOD();
        if ($uri === '/') {
            $appController = new AppController();
            $appController->index();
        }
        if ($method === "GET") {
            foreach ($this->routes['GET'] as $uriPattern => $path) {
                if (preg_match("~$uriPattern~", $uri)) {
                    if ($path[0] === 'user') {
                        $controllerObject = new UserController();
                    }
                    $actionName = $path[1];
                    $result = $controllerObject->$actionName();

                    if ($result != null) {
                        break;
                    }
                }
            }
        }
        if ($method === "POST") {
            foreach ($this->routes['POST'] as $uriPattern => $path) {
                    $uriArray = explode('/', $uri);
                if (preg_match("~users/\d*$~", $uri)) {
                    if (isset($uriArray[2])) {
                        if (preg_match("~\d~", $uriArray[2])) {
                            $controllerObject = new UserController();
                            $controllerObject->delete();
                            break;
                        }
                    }
                }
                if (preg_match("~users/update/\d*$~", $uri)) {
                    if (isset($uriArray[2])) {
                        if (preg_match("~\d~", $uriArray[3])) {
                            $controllerObject = new UserController();
                            $controllerObject->update();
                            break;
                        }
                    }
                }
                if (preg_match("~$uriPattern~", $uri)) {
                    if ($path[0] === 'user') {
                        $controllerObject = new UserController();
                    }
                    $actionName = $path[1];
                    $result = $controllerObject->$actionName();
                    if ($result != null) {
                        break;
                    }
                }
            }
        }
    }
}
