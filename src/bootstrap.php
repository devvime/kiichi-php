<?php

require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../src/Config/config.php');
require_once(__DIR__.'/../src/Config/database.php');

use Devvime\Kiichi\Engine\HttpService;

HttpService::json();
HttpService::cors();

require_once('routes.php');