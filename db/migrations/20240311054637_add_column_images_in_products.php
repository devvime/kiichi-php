<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnImagesInProducts extends AbstractMigration
{
    /**
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     */
    public function change(): void
    {
        $this->table('products')
            ->addColumn('images', 'json')
            ->addColumn('createAt', 'datetime')
            ->addColumn('updateAt', 'datetime')
            ->save();
    }
}
