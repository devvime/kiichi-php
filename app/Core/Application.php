<?php

namespace App\Core;

use App\Core\HttpService;

class Application {

    public $path;
    public $http;
    public $params = [];

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

    public function getParams($route)
    {
        $pathArray = explode('/', $this->path);
        $routeArray = explode('/', $route);
        for ($i=0; $i < count($routeArray); $i++) {
            if (strpos($routeArray[$i], ":") !== false) {                
                $this->params[str_replace(":", '', $routeArray[$i])] = $pathArray[$i];
                $routeArray[$i] = $pathArray[$i];
            }
        }
        return implode('/', $routeArray);
    }

    public function verify($route, $controller, $method)
    {        
        if ($this->getParams($route) === $this->path && $this->http === $method && is_string($controller)) {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $callback = $controller[1];
            $request = new \stdClass;
            foreach ($this->params as $key => $value) {
                @$request->params->$key = $value;
            }
            foreach (HttpService::request() as $key => $value) {
                @$request->body->$key = $value;
            }
            foreach ($_GET as $key => $value) {
                @$request->query->$key = $value;
            }
            // $request = [
            //     "params"=>$this->params,
            //     "body"=>HttpService::request(),
            //     "query"=>$_GET
            // ];
            $class->$callback($request);
        } else if($route === $this->path && $this->http === $method && !is_string($controller)) {
            $callback = $controller;
            $callback();
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