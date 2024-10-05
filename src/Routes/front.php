<?php

$router->get('/', function ($req, $res) {
  $res->render('components/home/home', [
    "version"=>$res->version()
  ]);
});

$router->get('/about', function ($req, $res) {
  $res->render('components/about/about', [
    "version"=>$res->version()
  ]);
});
