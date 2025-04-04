<?php
#
#Root Path
define('__ROOT__', dirname(dirname(__DIR__)));
#
#Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__ROOT__);
$dotenv->load();
#
#Timezone Settings
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, 'pt_BR');
#
#Database Settings
define('DBDRIVER', $_ENV['DBDRIVER']);
define('DBHOST', $_ENV['DBHOST']);
define('DBUSER', $_ENV['DBUSER']);
define('DBPASS', $_ENV['DBPASS']);
define('DBNAME', $_ENV['DBNAME']);
#
#Email Settings
define('EMAIL_HOST', $_ENV['EMAIL_HOST']);
define('EMAIL_USER', $_ENV['EMAIL_USER']);
define('EMAIL_PASSWORD', $_ENV['EMAIL_PASSWORD']);
define('EMAIL_PORT', $_ENV['EMAIL_PORT']);
#
#JWT Settings
define('SECRET', $_ENV['SECRET']);
#
#Upload Settings
const UPLOAD_DIR = 'public/uploads';
#
#Views Settings
const VIEWS_DIR = __ROOT__.'/client/';
const VIEWS_CACHE_DIR = __ROOT__.'/client/default/cache/';
const HEADER_DATA = [
  "author" => "Authro here...", 
  "description" => "Description here..."
];
const VERSION = '1.0.0';
#
