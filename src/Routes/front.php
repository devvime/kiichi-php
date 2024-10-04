<?php

$router->get('/', function ($req, $res) {
  $version = round(microtime(true) * 1000);
  $res->render('components/home/index', [
    "version"=>$version
  ]);
});

$router->get('/test', function ($req, $res) {
  $version = round(microtime(true) * 1000);
  $res->render('components/test/index', [
    "version"=>$version
  ]);
});
