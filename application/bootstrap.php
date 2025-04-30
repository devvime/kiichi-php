<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Config/config.php');
require_once(__DIR__ . '/Config/database.php');

use Devvime\Kiichi\Engine\HttpService;
use Devvime\Kiichi\Engine\Router;

session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();
session_regenerate_id(true);

$router = new Router();

HttpService::json();
HttpService::cors();

require_once('Routes/client.php');
require_once('Routes/server.php');

$router->run();
