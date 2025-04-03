<?php

require_once('application/Config/config.php');

switch (DBDRIVER) {
  case 'mysql':
    return
      [
        'paths' => [
          'migrations' => '%%PHINX_CONFIG_DIR%%/application/Database/migrations',
          'seeds' => '%%PHINX_CONFIG_DIR%%/application/Database/seeds'
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
    break;
  case 'sqlite':
    return
      [
        'paths' => [
          'migrations' => '%%PHINX_CONFIG_DIR%%/application/Database/migrations',
          'seeds' => '%%PHINX_CONFIG_DIR%%/application/Database/seeds'
        ],
        'environments' => [
          'default_migration_table' => 'phinxlog',
          'default_environment' => 'development',
          'production' => [
            'adapter' => 'sqlite',
            'name' => '%%PHINX_CONFIG_DIR%%/db/database',
          ],
          'development' => [
            'adapter' => 'sqlite',
            'name' => '%%PHINX_CONFIG_DIR%%/db/database',
          ],
          'testing' => [
            'adapter' => 'sqlite',
            'name' => '%%PHINX_CONFIG_DIR%%/db/database',
          ]
        ],
        'version_order' => 'creation'
      ];
    break;
}
