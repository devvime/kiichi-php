<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Products extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('products');
        $table->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('price', 'integer')
            ->create();
    }
}
