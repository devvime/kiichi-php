<?php

require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../src/Config/config.php');
require_once(__DIR__.'/../src/Config/database.php');

use Devvime\Kiichi\Engine\HttpService;
use Devvime\Kiichi\Engine\Router;

$router = new Router();

HttpService::json();
HttpService::cors();

require_once('Routes/front.php');
require_once('Routes/api.php');

$router->run();