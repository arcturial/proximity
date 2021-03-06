<?php
$app->match('/auth/login', 'App\Controller\AuthController::loginAction')
    ->method('POST|GET');

$app->get('/auth/logout', 'App\Controller\AuthController::logoutAction');

$app->get('/', 'App\Controller\IndexController::indexAction')
    ->secure();

$app->get('/beacons/', 'App\Controller\BeaconController::indexAction')
    ->secure();

$app->match('/beacons/add', 'App\Controller\BeaconController::addAction')
    ->method('POST|GET')
    ->secure();

$app->match('/account/overview', 'App\Controller\AccountController::overviewAction')
    ->method('POST|GET')
    ->secure();