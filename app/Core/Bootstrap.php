<?php

require_once('App/Config/Config.php');
require_once('App/Routes.php');

use App\Core\HttpService;               

HttpService::json();
HttpService::cors();