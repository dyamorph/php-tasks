<?php

declare(strict_types=1);

namespace router;

use controllers\AppController;
use controllers\UserController;
use core\Request;

class Router
{
    private array $routes;
    public Request $request;

    public function __construct()
    {
        $routesPath = __DIR__.'/../routes/web.php';
        $this->routes = include($routesPath);
        $this->request = new Request();
    }

    public function run(): void
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();
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

