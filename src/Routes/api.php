<?php

$router->post('/register', 'UserController@store');

$router->group('/auth', function () use ($router) {
  $router->post('', 'AuthController@index');
  $router->post('/recover-pass', 'RecoverPasswordController@index');
  $router->post('/recover-password', 'RecoverPasswordController@store');
  $router->get('/verify', function ($req, $res) {
  }, 'AuthMiddleware@verify');
});

$router->group('/user', function () use ($router) {
  $router->get('', 'UserController@index');
  $router->get('/:id', 'UserController@find');
  $router->post('', 'UserController@store');
  $router->put('/:id', 'UserController@update');
  $router->delete('/:id', 'UserController@destroy');
}, 'AuthMiddleware@index');