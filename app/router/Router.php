<?php

namespace App\Router;

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
        $this->routes = require $_SERVER['DOCUMENT_ROOT'] . '/app/router/routes.php';
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
        $route = $this->getRoute();
        if ($route) {
            $controllerName = '\\App\\Controllers\\' . $route[2][0];
            $actionName = $route[2][1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->$actionName();
                } else {
                    throw new \Exception("Action $actionName not found in controller $controllerName");
                }
            } else {
                throw new \Exception("Controller $controllerName not found");
            }
        } else {
            throw new \Exception("No route found for URL " . implode('/', $this->url));
        }
    }
}
