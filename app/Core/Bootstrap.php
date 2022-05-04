<?php

require_once('App/Config/Config.php');
require_once('App/Core/Database.php');
require_once('App/Controllers/Sql.php');
require_once('App/Core/ControllerService.php');
require_once('App/Core/HttpService.php');
require_once('App/Core/FileService.php');
require_once('App/Core/Route.php');
require_once('App/Routes.php');

use App\Core\HttpService;               

HttpService::json();
HttpService::cors();