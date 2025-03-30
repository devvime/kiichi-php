<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

switch (DBDRIVER) {
  case 'mysql':
    $capsule->addConnection([
      "driver" => DBDRIVER,
      "host" => DBHOST,
      "database" => DBNAME,
      "username" => DBUSER,
      "password" => DBPASS,
      "charset" => "utf8",
      "collation" => "utf8_unicode_ci",
      'prefix' => ''
    ]);
    break;
  case 'sqlite':
    $capsule->addConnection([
      'driver'   => 'sqlite',
      'database' => __DIR__ . '/../../db/database.sqlite3',
      'prefix'   => '',
    ]);
    break;
}

$capsule->setAsGlobal();
$capsule->bootEloquent();
