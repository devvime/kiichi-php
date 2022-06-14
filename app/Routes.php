<?php

use App\Core\Application;

$app = new Application();

$app->get('/', function() {
    echo json_encode(['title'=>'Simple CRUD PHP']);
});

$app->get('/user', 'UserController@index');
$app->post('/user','UserController@store');
$app->put('/user','UserController@update');
$app->delete('/user','UserController@destroy');

$app->get('/user/:id/:name', 'UserController@find');
$app->post('/user/:id/:name', 'UserController@find');