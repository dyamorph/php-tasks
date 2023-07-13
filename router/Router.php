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
        $routesPath = __DIR__.'/../routes/web.php';
        $this->routes = include($routesPath);
    }

    private function getURI(): string
    {
        if ( ! empty($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
        return '';
    }

    private function getMETHOD(): string
    {
        if ( ! empty($_SERVER['REQUEST_METHOD'])) {
            return $_SERVER['REQUEST_METHOD'];
        }
        return '';
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
                $uriArray = explode('/', $uri);

                if (isset($uriArray[2])
                    && preg_match("~/users/edit/\d*\?$~", $uri)
                    && preg_match("~\d*\?~", $uriArray[3])
                ) {
                    $id = rtrim($uriArray[3], '?');
                    $controllerObject = new UserController();
                    $controllerObject->edit($id);
                    break;
                }

                if (preg_match("~$uriPattern~", $uri)) {
                    if ($path[0] === 'user') {
                        $controllerObject = new UserController();
                    }
                    $actionName = $path[1];
                    if (isset($controllerObject)) {
                        $result = $controllerObject->$actionName();
                        if ($result !== null) {
                            break;
                        }
                    }
                }
            }
        }
        if ($method === "POST") {
            foreach ($this->routes['POST'] as $uriPattern => $path) {
                $uriArray = explode('/', $uri);
                if (isset($uriArray[2]) && preg_match("~users/\d*$~", $uri)) {
                    $id = $uriArray[2];
                    $controllerObject = new UserController();
                    $controllerObject->delete($id);
                    break;
                }
                if (isset($uriArray[2]) && preg_match("~users/update/\d*$~", $uri)) {
                    $id = $uriArray[3];
                    $controllerObject = new UserController();
                    $controllerObject->update($id);
                    break;
                }
                if (preg_match("~$uriPattern~", $uri)) {
                    if ($path[0] === 'user') {
                        $controllerObject = new UserController();
                    }
                    $actionName = $path[1];
                    if (isset($controllerObject)) {
                        $result = $controllerObject->$actionName();
                        if ($result !== null) {
                            break;
                        }
                    }
                }
            }
        }
    }
}

