<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class AddProduct extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Notebook',
                'description' => 'Lorem Ipsum is simply dummy, Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 1999,
                'createAt' => date('Y-m-d H:i:s'),
                'updateAt' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Monitor',
                'description' => 'Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 599,
                'createAt' => date('Y-m-d H:i:s'),
                'updateAt' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Teclado',
                'description' => 'Lorem Ipsum is simply dummy, Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 139,
                'createAt' => date('Y-m-d H:i:s'),
                'updateAt' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Mouse',
                'description' => 'Lorem Ipsum is simply dummy, Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 49,
                'createAt' => date('Y-m-d H:i:s'),
                'updateAt' => date('Y-m-d H:i:s')
            ]
        ];
        $products = $this->table('products');
        $products->insert($data)->save();
    }
}
