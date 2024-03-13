# Kiichi PHP

Simple Framework PHP MVC for developing web API`s.

***

### Specifications and Dependencies

- **PHP Version** >= 8.1.0
- [Composer](https://getcomposer.org/)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- [Eloquent ORM](https://laravel-docs-pt-br.readthedocs.io/en/latest/eloquent/)
- [RainTPL 3](https://github.com/feulf/raintpl3)
- [php-jwt](https://github.com/firebase/php-jwt)
- [phpdotenv](https://github.com/vlucas/phpdotenv)
- [Pest](https://github.com/pestphp/pest)
- [Phinx](https://github.com/cakephp/phinx)

#### install packages

in the root of the project, run the composer command 

```
composer update
```

***

### Routes

The project's routes are located inside the Routes.php file inside the App folder.

```
├── App
│  └── Routes.php
```

#### Configuration

```php
<?php

use App\Core\Application;

$app = new Application();
```

#### Creating routes

Route and Function

```php
$app->get('/', function($req, $res) {
    $res->json(['title'=>'Simple CRUD PHP']);
});
```

Route and Class

```php
$app->get('/:id', 'UserController@find');
```

Group of routes and parameters in URL

```php
$app->group('/hello', function() use($app) {
    $app->get('/:name', function($req, $res) {
        $res->render('html-file-name', [
            "name"=>$req->params->name            
        ]);
    });
});

$app->group('/user', function() use($app) {
    $app->get('', 'UserController@index');
    $app->get('/:id', 'UserController@find');
    $app->post('', 'UserController@store');
    $app->put('/:id', 'UserController@update');
    $app->delete('/:id', 'UserController@destroy');
});
```

Route and Middleware

```php

// Middleware in  Function
$app->get('/:id', 'UserController@find', function() {
    // Middleware code...
});

// Middleware in Class
$app->get('/:id', 'UserController@find', 'UserMiddleware@verifyAuthToken');

// Middleware Function in Route Group

$app->group('/user', function() use($app) {
    $app->get('', 'UserController@index');
    $app->get('/:id', 'UserController@find');
    $app->post('', 'UserController@store');
    $app->put('/:id', 'UserController@update');
    $app->delete('/:id', 'UserController@destroy');
}, function() {
    // Middleware code...
});

// Middleware Class in Route Group

$app->group('/user', function() use($app) {
    $app->get('', 'UserController@index');
    $app->get('/:id', 'UserController@find');
    $app->post('', 'UserController@store');
    $app->put('/:id', 'UserController@update');
    $app->delete('/:id', 'UserController@destroy');
}, 'AuthMiddleware@verifyToken');
```

#### Request data

Request data in URL Query ex: http://api.server.com/user?name=steve

```php
$app->post('/user', function($req, $res) {
    $name = $req->query->name;
});
```

Request post data JSON 

```php
$app->post('/user', function($req, $res) {
    $name = $req->body->name;
    $email = $req->body->email;
});
```

Request params in URL

```php
$app->put('/:id', function($req, $res) {
    $id = $req->params->id;
});
```

Start routes

```php
$app->run();
```

### Create Controller

To create a new controller with the assistant, just type the following command, informing the name of the controller and the name of the database table that will be used -> EX: composer new controller controllerName tableName.

```
composer new controller product products
```

Result:

```
├── App
|  ├── Controllers
│  |  └── ProductController.php
|  |── Models
|  |  └── Products.php
```

### Create Middleware

To create a new middleware with the wizard, just type the following command informing the name of the middleware.

```
composer new middleware product
```

Result:

```
├── App
|  ├── Middlewares
│  |  └── ProductMiddleware.php
```

### Create new email controller

Type the following command informing the name of the mail controller.

```
composer new mail news
```

Result:

```
├── App
|  ├── Controllers
│  |  └── NewsController.php
```

### Migrations

To create a new migration, simply type the following command in the project root (use CamelCase format):

```
composer new-migration MyMigration
```

Result:

```
├── db
|  ├── Migrations
│  |  └── 20240311052948_MyMigration.php
```

Migration code:

```php
<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyMigration extends AbstractMigration
{
    public function change(): void
    {

    }
}
```

Example to create table:

```php
<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MyMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('table-name');
        $table->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('files', 'json')
            ->addColumn('amount', 'json')
            ->create();
    }
}
```

More information on writing migrations is available here:
[https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method](https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method)

After configuring database access in the .ENV file and having a database created, simply enter this command to run the migrations and create the tables:

```
composer migrate
```

#### Rollback

To undo the migration changes you made, simply run this command:

```
composer rollback
```

### Seeders

To create a new seed, simply type the following command in the project root (use CamelCase format):

```
composer new-seed MySeed
```

Result:

```
├── db
|  ├── Seeds
│  |  └── MySeed.php
```

Seed code:

```php
<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class MySeed extends AbstractSeed
{
    public function run(): void
    {

    }
}
```

Seed example:

```php
<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class MySeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Notebook',
                'description' => 'Lorem Ipsum is simply dummy, Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 1999
            ],
            [
                'name' => 'Monitor',
                'description' => 'Lorem Ips incorrectly asserts that Lorem Ips correctly asserts.',
                'price' => 599
            ]
        ];
        $products = $this->table('products');
        $products->insert($data)->save();
    }
}
```

More information on writing seeders is available here:
[https://book.cakephp.org/phinx/0/en/seeding.html](https://book.cakephp.org/phinx/0/en/seeding.html)

After configuring database access in the .ENV file and having a database created, simply enter this command to run the seed and create data in table:

```
composer run-seed
```

#### Render HTML file

To render an HTML file just use $res->render('file-name');
no need to add .html in file name

```php
$app->get('/user', function($req, $res) use($app) {
    $res->render('html-file-name');
});
```

To render an HTML file by sending an array of data use $res->render('file-name');

```php
$app->get('/user', function($req, $res) use($app) {
    $res->render('html-file-name', [
        "name"=>$user->name,
        "email"=>$user->email,
        "product"=>$productArray
    ]);
});
```

To receive the data sent to the HTML file use {{ key }} or {{ key.object.name }}

```html
<div class="card">
    <h4>{$name }/h4>
    <p>{$email}</p>
    <hr/>
    <p>{$product.title}</p>
    <p>{$product.description}</p>
    <p>{$product.price}</p>
</div>
```

For more details, see the documentation at [RainTPL 3](https://github.com/feulf/raintpl3)


