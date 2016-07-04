<?php
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app->register(new TwigServiceProvider, array(
    'twig.path' => __DIR__ . '/../views',
    'debug'     => true
));

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

    $merge = function ($defaults, $attr) {

        foreach ($defaults as $key => $value) {
            $attr[$key] = trim(@$attr[$key] . ' ' . $value);
        }

        return $attr;
    };

    $html = function ($attr) {
        $return = '';

        foreach ($attr as $key => $value) {
            $return .= $key . '="' . $value . '" ';
        }

        return trim($return);
    };

    $safe = ['is_safe' => ['html']];


    $twig->addFunction(new \Twig_SimpleFunction('form_start', function ($attr = []) use ($app, $merge, $html, $safe) {

        $attr = $merge(['method' => 'POST', 'class' => 'form-horizontal'], $attr);

        return '<form action="" ' . $html($attr) . '/>';
    }, $safe));

    $twig->addFunction(new \Twig_SimpleFunction('form_end', function ($attr = []) use ($app, $merge, $html) {
        return '<form/>';
    }, $safe));


    $twig->addFunction(new \Twig_SimpleFunction('form_text', function ($attr) use ($app, $merge, $html) {

        $attr = $merge(['class' => 'form-control'], $attr);

        return '
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <input type="text" ' . $html($attr) . ' />
                        <div class="input-group-addon">.00</div>
                    </div>
                </div>
            </div>';
    }, $safe));

    $twig->addFunction(new \Twig_SimpleFunction('form_password', function ($attr) use ($app, $merge, $html) {

        $attr = $merge(['class' => 'form-control'], $attr);

        return '
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <input type="password" ' . $html($attr) . ' />
                        <div class="input-group-addon">.00</div>
                    </div>
                </div>
            </div>';
    }, $safe));

    $twig->addFunction(new \Twig_SimpleFunction('form_submit', function ($attr) use ($app, $merge) {

        $attr = $merge(['label' => 'Submit'], $attr);

        return '
            <div class="form-group text-right">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block">' . $attr['label'] . '</button>
                </div>
            </div>';
    }, $safe));

    return $twig;
});