<?php

$router->post('/api/register', 'UserController@store');

$router->group('/api/auth', function () use ($router) {
  $router->post('', 'AuthController@index');
  $router->post('/recover-pass', 'RecoverPasswordController@index');
  $router->post('/recover-password', 'RecoverPasswordController@store');
  $router->get('/logout', function ($req, $res) {
    session_unset();
    session_destroy();
    $res->json([
      "status" => 200,
      "success" => true,
      "message" => "Successfully logged out!"
    ]);
  });
});

$router->group('/api/user', function () use ($router) {
  $router->get('', 'UserController@index');
  $router->get('/:id', 'UserController@find');
  $router->post('', 'UserController@store');
  $router->put('/:id', 'UserController@update');
  $router->delete('/:id', 'UserController@destroy');
}, 'AuthMiddleware@index');