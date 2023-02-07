<?php

require_once('vendor/autoload.php');
require_once('App/Config/Config.php');

use App\Core\HttpService;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$config = [
    "driver"=>'mysql',
    "host"=>DBHOST,
    "database"=>DBNAME,
    "username"=>DBUSER,
    "password"=>DBPASS,
    "charset"=>"utf8",
    "collation"=>"utf8_unicode_ci"
];

$capsule->addConnection($config);
$capsule->bootEloquent();

HttpService::json();
HttpService::cors();

require_once('App/Routes.php');
