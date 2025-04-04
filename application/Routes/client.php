<?php

# documentation
$router->get('/doc', function ($req, $res) {
  $res->render('default/doc/doc', [
    "header"=>false,
    "footer"=>false,
    "version"=>$res->version(),
  ]);
});

$router->get('/doc-data', function ($req, $res) {
  $conteudo = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../README.md');
  echo $conteudo;
});
# end documentation

$router->get('/', function ($req, $res) {
  $res->render('app/pages/home/home', [
    "version"=>$res->version()
  ]);
});

$router->get('/login', function ($req, $res) {
  $res->render('app/pages/login/login', [
    "version"=>$res->version()
  ]);
});

$router->group('/dashboard',  function () use ($router) {

  $router->get('', function ($req, $res) {
    $res->render('components/dashboard/dashboard', [
      "version"=>$res->version()
    ]);
  });

  $router->get('/users', function ($req, $res) {
    $res->render('components/dashboard/dashboard', [
      "version"=>$res->version()
    ]);
  });
  
}, 'AuthMiddleware@index');
