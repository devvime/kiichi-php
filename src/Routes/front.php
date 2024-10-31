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
