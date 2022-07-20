<?php

use App\Core\Application;

$app = new Application();

$app->get('/', function($req, $res) {
    $res->json(['title'=>'Simple CRUD PHP']);
});

$app->group('/hello');
    $app->get('/:name', function($req, $res) {
        $res->render('index', [
            "name"=>$req->params->name            
        ]);
    });

$app->group('/user');
    $app->get('', 'UserController@index');
    $app->get('/:id', 'UserController@find');
    $app->post('', 'UserController@store');
    $app->put('', 'UserController@update');
    $app->delete('', 'UserController@destroy');       

$app->group('/test');
    $app->get('', function($req, $res) {
        $res->json([
            "message"=>"Test"
        ]);
    });

$app->run();
