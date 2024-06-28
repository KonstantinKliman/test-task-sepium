<?php

namespace App\Router;

use App\Views\View;

class Router
{
    private $routes = [];
    private $url;
    private $method;

    public function __construct(string $url, string $method)
    {
        $this->url = explode('/', trim($url, '/'));
        $this->method = $method;
        $this->loadRoutes();
    }

    private function loadRoutes()
    {
        $this->routes = require $_SERVER['DOCUMENT_ROOT'] . '/../App/Router/routes.php';
    }

    private function getRoute()
    {
        foreach ($this->routes as $route) {
            if ($route[0] === $this->method && $route[1] === '/' . implode('/', $this->url)) {
                return $route;
            }
        }
        return null;
    }

    public function dispatch()
    {
//        echo '<pre>';
//        var_dump($this->method);
//        echo '</pre>';
        $route = $this->getRoute();
        if ($route) {
            $controllerName = '\\App\\Controllers\\' . $route[2][0];
            $actionName = $route[2][1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                } else {
                    View::error(new \Exception("Action $actionName not found in controller $controllerName", 404));
                }
            } else {
                View::error(new \Exception("Controller $controllerName not found", 404));
            }
        } else {
            View::error(new \Exception("No route found for URL " . implode('/', $this->url), 404));
        }
    }
}
