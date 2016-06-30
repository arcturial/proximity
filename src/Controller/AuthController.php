<?php
namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Proximity\User;

class AuthController
{
    private function getUserService(Application $app)
    {
        return new \App\Service\UserService($app['db'], new \App\Persister);
    }

    private function getAuth(Application $app)
    {
        return new \App\Auth($this->getUserService($app), $app['session']);
    }

	public function loginAction(Application $app, Request $request)
	{
        if ($request->isMethod('POST')) {

            $result = $this->getAuth($app)->authenticate('test@test.com', 'test');

            return $app->redirect('/');
        }

        //$user = new \App\Entity\User;
        //$this->getUserService($app)->create($user);

        return $app->render('auth/login.html.twig', []);
	}
}