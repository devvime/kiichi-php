<?php

$router->get('/', function ($req, $res) {
  $res->render('components/home/home', [
    "version"=>$res->version(),
    "headerData"=>[
      "version"=>$res->version()
    ]
  ]);
});

$router->get('/login', function ($req, $res) {
  $res->render('components/login/login', [
    "version"=>$res->version()
  ]);
});

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
