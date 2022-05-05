<?php

namespace App\Core;

class Route {

    public $path;
    public $http;

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->http = $_SERVER['REQUEST_METHOD'];
    }

    public function getController($controller) 
    {
        if (file_exists("App\\Controllers\\{$controller}.php")) {
            require_once("App\\Controllers\\{$controller}.php");
            $class = "App\\Controllers\\". $controller;
            return new $class();
        }
    }

    public function verify($route, $controller, $method)
    {
        if ($route === $this->path && $this->http === $method && is_string($controller)) {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $func = $controller[1];
            $class->$func();
        } else if($route === $this->path && $this->http === $method && !is_string($controller)) {
            $func = $controller;
            $func();
        }
    }

    public function get($route, $controller)
    {
        $this->verify($route, $controller, 'GET');
    }

    public function post($route, $controller)
    {
        $this->verify($route, $controller, 'POST');
    }

    public function put($route, $controller)
    {
        $this->verify($route, $controller, 'PUT');
    }

    public function delete($route, $controller)
    {
        $this->verify($route, $controller, 'DELETE');
    }

    public static function json($data)
    {
        echo json_encode($data);
    }

}