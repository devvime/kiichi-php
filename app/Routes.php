<?php

use App\Core\Route;

$app = new Route();

$app->get('/', function() {
    Route::json(['title'=>'Simple CRUD PHP']);
});
$app->get('/user', 'UserController@index');
$app->post('/user','UserController@store');
$app->put('/user','UserController@update');
$app->delete('/user','UserController@destroy');