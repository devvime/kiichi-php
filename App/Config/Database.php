<?php

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
$capsule->setAsGlobal();
$capsule->bootEloquent();