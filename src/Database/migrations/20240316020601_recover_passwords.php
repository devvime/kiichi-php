<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RecoverPasswords extends AbstractMigration
{
  public function change(): void
  {
    $table = $this->table('recoverPasswords');
    $table->addColumn('userId', 'integer')
      ->addColumn('token', 'string')
      ->addIndex(['token'], ['unique' => true])
      ->addColumn('isValid', 'integer')
      ->addColumn('createAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updateAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->create();
  }
}
