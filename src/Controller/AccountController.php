<?php
namespace App\Controller;

use App\Application;
use Arcturial\Kontakt\KontaktClient;
use Arcturial\Kontakt\Resource\Device;
use Symfony\Component\HttpFoundation\Request;

class AccountController
{
    private function getUserService(Application $app)
    {
        return new \App\Service\UserService($app['db'], new \App\Persister);
    }

    private function getAuth(Application $app)
    {
        return new \App\Auth($this->getUserService($app), $app['session']);
    }

	public function overviewAction(Application $app, Request $request)
	{
        $user = $this->getAuth($app)->authenticatedUser();

		return $app->render('account/overview.html.twig', []);
	}
}