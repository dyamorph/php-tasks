<?php
declare(strict_types=1);

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/routes/web.php';
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
    public function run()
    {
        $uri = $this->getURI();
        $method = $this->getMETHOD();
        if ($uri === '/') {
            $controllerFile = ROOT . '/controllers/AppController.php';
            if (file_exists($controllerFile)) {
                include_once ($controllerFile);
            }
            $appController = new AppController;
            $result = $appController->index();
        }
        if ($method === "GET") {
            foreach ($this->routes['GET'] as $uriPattern => $path) {
                if (preg_match("~$uriPattern~", $uri)) {
                    $controllerName = ucfirst($path[0]) . 'Controller';
                    $actionName = $path[1];
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once ($controllerFile);
                    }
                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$actionName();
                    if ($result != null) {
                        break;
                    }
                }
            }
        }
        if ($method === "POST") {
            foreach ($this->routes['POST'] as $uriPattern => $path) {
                if (preg_match("~$uriPattern~", $uri)) {
                    $controllerName = ucfirst($path[0]) . 'Controller';
                    $actionName = $path[1];
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once ($controllerFile);
                    }
                    $controllerObject = new $controllerName;
                    $result = $controllerObject->$actionName();
                    if ($result != null) {
                        break;
                    }
                }
            }
        }
    }
}
