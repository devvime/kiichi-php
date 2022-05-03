<?php

require_once('App/Core/Bootstrap.php');

use App\Core\Route;

$route = new Route();

$route->get('/', 'TestController@index');
$route->post('/','TestController@store');
$route->put('/','TestController@update');
$route->delete('/','TestController@destroy');

?>