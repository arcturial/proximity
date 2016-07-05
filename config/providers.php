<?php
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;

$app->register(new TwigServiceProvider, array(
    'twig.path' => __DIR__ . '/../views',
    'twig.form.templates' => ['bootstrap_3_layout.html.twig'],
    'debug'     => true
));


$app->register(new FormServiceProvider());


$app->register(new SessionServiceProvider);

$app->register(new MonologServiceProvider, array(
    'monolog.logfile' => 'php://stdout',
));

$app->register(new DoctrineServiceProvider, array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__ . '/app.db',
    )
));

$app->extend('twig', function($twig, $app) {
    $twig->addFilter('md5', new \Twig_Filter_Function('md5'));

    $twig->addFunction(new \Twig_SimpleFunction('relative_url', function ($value) use ($app) {
        return $app['request_stack']->getCurrentRequest()->getUriForPath('/' . ltrim($value, '/'));
    }));

    // Support without translations
    $twig->addFilter('trans', new \Twig_Filter_Function(function ($value) { return $value; }));

    return $twig;
});