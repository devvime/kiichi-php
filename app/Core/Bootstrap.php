<?php

require_once('vendor/autoload.php');
require_once('App/Config/Config.php');

use App\Core\HttpService;

HttpService::json();
HttpService::cors();

require_once('App/Routes.php');
