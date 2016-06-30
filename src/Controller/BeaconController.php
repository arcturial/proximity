<?php
namespace App\Controller;

use App\Application;
use Arcturial\Kontakt\KontaktClient;
use Arcturial\Kontakt\Resource\Device;
use Symfony\Component\HttpFoundation\Request;

class BeaconController
{
    private function getUserService(Application $app)
    {
        return new \App\Service\UserService($app['db'], new \App\Persister);
    }

    private function getBeaconService(Application $app)
    {
        return new \App\Service\BeaconService($app['db'], new \App\Persister);
    }

    private function getAuth(Application $app)
    {
        return new \App\Auth($this->getUserService($app), $app['session']);
    }

	public function indexAction(Application $app, Request $request)
	{
        $user = $this->getAuth($app)->authenticatedUser();

        $beacons = $this->getBeaconService($app)->fetchBeaconsByUserId($user['id'], new \App\Paging($request->get('page'), $request->get('offset')));

		return $app->render('beacons/list.html.twig', [
            'beacons' => $beacons
        ]);
	}

    public function addAction(Application $app, Request $request)
    {
        if ($beacon = $request->get('beacon')) {

            $beacon = new \App\Entity\Beacon($beacon);
            $beacon['user_id'] = $this->getAuth($app)->authenticatedUser()['id'];

            if ($this->getBeaconService($app)->create($beacon)) {

                $app->success('Beacon created successfully.');
                return $app->redirect('/beacons');
            }
        }

        return $app->render('beacons/detail.html.twig', []);
    }
}