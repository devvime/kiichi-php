<?php

use Devvime\Kiichi\Engine\Application;

$app = new Application();

$app->get('/', function($req, $res) {
    $res->json([
        'title'=>'Kiichi PHP',
        "description"=>"Simple Framework PHP MVC for developing web API`s.",
        "author"=>[
            "name"=>"Victor Alves Mendes",
            "github"=>"https://github.com/devvime"
        ]
    ]);
});

$app->get('/hello/:name', function($req, $res) {
    $res->render('index', [
        "name"=>$req->params->name
    ]);
});   

$app->group('/user', function() use($app) {
    $app->get('', 'UserController@index');
    $app->get('/:id', 'UserController@find');
    $app->post('', 'UserController@store');
    $app->put('/:id', 'UserController@update');
    $app->delete('/:id', 'UserController@destroy');
}, 'UserMiddleware@logged');

$app->run();
