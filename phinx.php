<?php

require_once('App/Config/config.php');

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => DBHOST,
            'name' => DBNAME,
            'user' => DBUSER,
            'pass' => DBPASS,
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => DBHOST,
            'name' => DBNAME,
            'user' => DBUSER,
            'pass' => DBPASS,
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => DBHOST,
            'name' => DBNAME,
            'user' => DBUSER,
            'pass' => DBPASS,
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
