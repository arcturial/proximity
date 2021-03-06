<?php
namespace Proximity\Route;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Route;

class CustomRoute extends Route
{
    public function secure()
    {
        $this->before(function (Request $request, Application $app) {
            if ($user = $request->getSession()->get('user')) {
                $app['twig']->addGlobal('user', $user);
            } else {
                $app->log('Access token invalid, page requires user authentication.');
                return $app->redirect('/login');
            }
        });

        return $this;
    }
}