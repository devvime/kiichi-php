<?php

use App\Core\Application;

$app = new Application();

$app->get('/', function($req, $res) {
    $res->json(['title'=>'Simple CRUD PHP']);
});

$app->group('/api');
    $app->get('/user', 'UserController@index');
    $app->get('/user/:id', 'UserController@find');
    $app->post('/user','UserController@store');
    $app->put('/user','UserController@update');
    $app->delete('/user','UserController@destroy');

$app->group('/hello');
    $app->get('/:name', function($req, $res) {
        $res->json([
            "Hello"=>$req->params->name
        ]);
    });

$app->run();
