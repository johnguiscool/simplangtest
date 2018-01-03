<?php

require 'vendor/autoload.php';
use \Slim\App;





$app = new \Slim\App();

$app->get('/', function ($request, $response, $args) {

  return $app->render('index.html');

});

$app->run();