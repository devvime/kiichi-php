<?php

use App\Core\Route;

$route = new Route();

$route->get('/', 'UserController@index');
$route->post('/','UserController@store');
$route->put('/','UserController@update');
$route->delete('/','UserController@destroy');