<?php

namespace App;

use Exception;

class Router
{
    private array $routes = [];
    private static Router $instance;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance(): Router
    {
        if (!isset(self::$instance)) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    private function addRoute(string $path, string $controller, string $action, string $method): void
    {
        $uri = URL_ROOT . $path;
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get(string $path, string $controller, string $action): void
    {
       $this->addRoute($path, $controller, $action, 'GET');
    }

    public function post(string $path, string $controller, string $action): void
    {
       $this->addRoute($path, $controller, $action, 'POST');
    }

    private function matchRoute(string $path, string $method): ?array
    {
        foreach ($this->routes[$method] as $route => $routeData) {
            $pattern = "#^" . preg_replace('/\{[^\/]+\}/', '([^/]+)', $route) . "$#";
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // Remove the full match
                return [$routeData, $matches];
            }
        }
        return null;
    }

    public function dispatch(): void
    {
        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];
        
        $route = $this->matchRoute($path, $method);
        if ($route) {
            [$routeData, $params] = $route;
            $controller = $routeData['controller'];
            $action = $routeData['action'];

            // Create controller instance
            $controllerInstance = new $controller();
            
            // Call action with parameters if available
            if (method_exists($controllerInstance, $action)) {
                call_user_func_array([$controllerInstance, $action], $params);
            } else {
                throw new Exception('Action not found');
            }
        } else {
            throw new Exception('404 - Not Found');
        }
    }
}
