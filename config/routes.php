<?php
$app->match('/login', 'App\Controller\AuthController::loginAction')
    ->method('POST|GET');

$app->get('/', 'App\Controller\IndexController::indexAction')
    ->secure();

$app->get('/beacons', 'App\Controller\BeaconController::indexAction')
    ->secure();

$app->match('/beacons/add', 'App\Controller\BeaconController::addAction')
    ->method('POST|GET')
    ->secure();

$app->get('/account/overview', 'App\Controller\AccountController::overviewAction')
    ->secure();