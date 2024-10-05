<?php

$router->get('/', function ($req, $res) {
  $res->render('components/home/index', [
    "version"=>$res->version()
  ]);
});

$router->get('/about', function ($req, $res) {
  $res->render('components/about/index', [
    "version"=>$res->version()
  ]);
});
