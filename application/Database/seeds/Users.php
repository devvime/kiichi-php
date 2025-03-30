<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
  public function run(): void
  {
    $data = [
      [
        'name' => 'Steve',
        'email' => 'steve@mail.com',
        'password' => 'dsrdrhdrjujh&jnseg654584'
      ],
      [
        'name' => 'Other Steve',
        'email' => 'other_steve@mail.com',
        'password' => '545864segeinj*¨%&jnseg654584'
      ],
      [
        'name' => 'I`m not Steve',
        'email' => 'imnot_steve@mail.com',
        'password' => 'afjhf73654414*&#'
      ]
    ];
    $users = $this->table('users');
    $users->insert($data)->save();
  }
}
