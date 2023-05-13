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
                $router->{$method}('/'. $prefixedUri, $controller);
            }
        }
    }

    public function dispatch()
    {
        $uri = '/' . trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        // print_r($this->routes);
        // print_r('<br/><Br/>');
        // print_r($uri);

        if (!isset($this->routes[$method][$uri])) {
            // Handle not found
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        [$controller, $method] = explode('@', $this->routes[$method][$uri]);

        $uriArr = explode('/', $uri);
        array_splice($uriArr, 0, 1);


        if($uriArr[0] == 'api') {
            require '../app/api/' . $controller . '.php';
        }  else {
            require '../app/controllers/' . $controller . '.php';
        }

        
        // print_r(method_exists($controller, $method) ? 1 : 2);
        if (!method_exists($controller, $method)) {
            // Handle method not found
            // http_response_code(500);
            // echo "Controller method not found";
            exit;
        }

        $controllerInstance = new $controller;
        $controllerInstance->$method();
    }
}