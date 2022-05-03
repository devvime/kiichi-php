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

    public function get($route, $controller)
    {
        if ($route === $this->path && $this->http === 'GET') {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $func = $controller[1];
            $class->$func();
        }
    }

    public function post($route, $controller)
    {
        if ($route === $this->path && $this->http === 'POST') {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $func = $controller[1];
            $class->$func();
        }
    }

    public function put($route, $controller)
    {
        if ($route === $this->path && $this->http === 'PUT') {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $func = $controller[1];
            $class->$func();
        }
    }

    public function delete($route, $controller)
    {
        if ($route === $this->path && $this->http === 'DELETE') {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $func = $controller[1];
            $class->$func();
        }
    }

}