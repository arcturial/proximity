<?php
namespace App;

use Symfony\Component\HttpFoundation\Request;
use Silex\Route as BaseRoute;

class Route extends BaseRoute
{
    public function secure()
    {
        $this->before(function (Request $request, Application $app) {

            if ($user = $request->getSession()->get('user')) {
                $app['twig']->addGlobal('user', $user);
            } else {
                //$app->log('Access token invalid, page requires user authentication.');
                return $app->redirect('/auth/login');
            }
        });

        return $this;
    }
}