<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/bootstrap/base-paths.php';
        $this->routes = include($routesPath);
    }
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
    }
    public function run()
    {
        $uri = $this->getURI();
        if ($uri === '/') {
            $controllerName = 'AppController';
            $actionName = 'index';
            $controllerFile = ROOT . '/controllers/AppController.php';
            if (file_exists($controllerFile)) {
                include_once ($controllerFile);
            }
            $appController = new AppController;
            $result = $appController->index();
        }
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $segments = explode('/', $path);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = array_shift($segments);
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
