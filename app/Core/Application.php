<?php

namespace App\Core;

use App\Core\HttpService;
use App\Core\ControllerService;

class Application {

    public $path;
    public $http;
    public $params = [];
    public $req;
    public $res;

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

    public function getParams($route, $method)
    {
        $this->req = new \stdClass;
        foreach (HttpService::request() as $key => $value) {
            @$this->req->body->$key = $value;
        }
        foreach ($_GET as $key => $value) {
            @$this->req->query->$key = $value;
        }
        $this->res = new ControllerService();
        if (strpos($route, ":") && $this->http === $method) {
            $pathArray = explode('/', $this->path);
            $routeArray = explode('/', $route);
            for ($i=0; $i < count($routeArray); $i++) {
                if (strpos($routeArray[$i], ":") !== false) {  
                    if (isset($routeArray[$i]) && isset($pathArray[$i])) {                        
                        $this->params[str_replace(":", '', $routeArray[$i])] = $pathArray[$i];
                        $routeArray[$i] = $pathArray[$i];
                    }                                  
                }
            }
            foreach ($this->params as $key => $value) {
                @$this->req->params->$key = $value;
            }
            return implode('/', $routeArray);
        } else {
            return $route;
        }
    }

    public function verify($route, $controller, $method)
    {        
        if ($this->getParams($route, $method) === $this->path && $this->http === $method && is_string($controller)) {
            $controller = explode('@', $controller);
            $class = $this->getController($controller[0]);
            $callback = $controller[1];           
            $class->$callback($this->req, $this->res);
            exit;
        } else if($route === $this->path && $this->http === $method && !is_string($controller)) {
            $callback = $controller;     
            $callback($this->req, $this->res);
            exit;
        }
        // echo "404";
        // exit;
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