<?php
require_once __DIR__ . '/vendor/autoload.php';
include_once 'app/RouteAction.php';
include_once 'loginfo.php';
// create instance of the Slim app
$app = new \Slim\App;
// need container to register my own class
$container = $app->getContainer();
// register RouteAction class with Slim
$container['RouteAction'] = function ($c) {
    return new RouteAction();
};
//create the test based route for the default URI
$app->get('/', \RouteAction::class . ':index');
$app->get('/breeds', \RouteAction::class . ':getBreeds');
$app->post('/breeds', \RouteAction::class . ':addBreed');
$app->get('/breeds/keyword/{keyword}', \RouteAction::class . ':searchBreeds');
// get app run
$app->run();
