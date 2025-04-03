<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
  public function change(): void
  {
    $table = $this->table('users');
    $table->addColumn('name', 'string')
      ->addColumn('email', 'string')
      ->addIndex(['email'], ['unique' => true])
      ->addColumn('password', 'string')
      ->addColumn('avatar', 'string', ['null' => true])
      ->addColumn('role', 'integer', ['default' => 0])
      ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updatedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();
  }
}
