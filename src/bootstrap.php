<?php

require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../src/Config/config.php');
require_once(__DIR__.'/../src/Config/database.php');

use Devvime\Kiichi\Engine\HttpService;
use Devvime\Kiichi\Engine\Router;

session_start();

$router = new Router();

HttpService::json();
HttpService::cors();

require_once('Routes/client.php');
require_once('Routes/server.php');

$router->run();