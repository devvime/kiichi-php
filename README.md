# Simple CRUD PHP

Simple Framework PHP MVC for developing web API`s.

***

### Specifications and Dependencies

- **PHP Version** >= 7.0.0
- [Composer](https://getcomposer.org/)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- [Eloquent ORM](https://laravel-docs-pt-br.readthedocs.io/en/latest/eloquent/)
- [RainTPL 3](https://github.com/feulf/raintpl3)
- [php-jwt](https://github.com/firebase/php-jwt)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

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

Route and Cunction

```php
$app->get('/', function($req, $res) {
    $res->json(['title'=>'Simple CRUD PHP']);
});
```

Route and Class

```php
$app->get('/', function($req, $res) {
    $res->json(['title'=>'Simple CRUD PHP']);
});
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
```


