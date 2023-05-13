<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
        // Add other request methods as needed...
    ];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function loadRoutes($filePath, $prefix = '')
    {
        $router = $this;
        $routes = require $filePath;
        foreach ($routes as $method => $routesByMethod) {
            foreach ($routesByMethod as $uri => $controller) {
                $prefixedUri = $prefix ? $prefix . '/' . ltrim($uri, '/') : $uri;
                $router->{$method}('/' . $prefixedUri, $controller);
            }
        }
    }

    public function dispatch()
    {
        $uri = '/' . trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $controllerAction) {
            $routePattern = preg_replace('/\{\w+\}/', '(\w+)', $route);

            if (preg_match("#^{$routePattern}$#", $uri, $matches)) {
                array_shift($matches); // The first element is the full match, which we don't need
                [$controller, $method] = explode('@', $controllerAction);
                $uriArr = explode('/', $uri);
                array_splice($uriArr, 0, 1);


                if ($uriArr[0] == 'api') {
                    require '../app/api/' . $controller . '.php';
                } else {
                    require '../app/controllers/' . $controller . '.php';
                }


                if (!method_exists($controller, $method)) {
                    http_response_code(500);
                    echo "Controller method not found";
                    exit;
                }
                

                $controllerInstance = new $controller;
                $controllerInstance->$method(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
        exit;
    }

}