<?php

require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../App/Config/config.php');
require_once(__DIR__.'/../App/Config/database.php');

use Devvime\Kiichi\Engine\HttpService;

HttpService::json();
HttpService::cors();

require_once('routes.php');