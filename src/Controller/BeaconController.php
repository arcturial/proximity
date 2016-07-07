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
        \App\Entity\Beacon::setGoogle($app['google']);


        $user = $this->getAuth($app)->authenticatedUser();

        $beacons = $this->getBeaconService($app)->fetchBeaconsByUserId($user['id'], new \App\Paging($request->get('page'), $request->get('offset')));

		return $app->render('beacons/list.html.twig', [
            'beacons' => $beacons
        ]);
	}

    public function addAction(Application $app, Request $request)
    {
        if ($data = $request->get('beacon')) {

            $beacon = new \App\Entity\Beacon($data);


            // Register with google
            $prox = new \Google_Service_ProximityBeacon($app['google']);

            $apiAdvertiser = new \Google_Service_Proximitybeacon_AdvertisedId();
            $apiAdvertiser->setId($beacon->advertiserId);
            $apiAdvertiser->setType('EDDYSTONE');

            $apiBeacon = new \Google_Service_Proximitybeacon_Beacon();
            $apiBeacon->setAdvertisedId($apiAdvertiser);
            $apiBeacon->setStatus('ACTIVE');

            $return = $prox->beacons->get('beacons/3!' . $beacon->getBeaconId());

            if (!empty($return)) {
                $beacon['user_id'] = $this->getAuth($app)->authenticatedUser()['id'];
                $this->getBeaconService($app)->create($beacon);

                $app->success('Beacon created successfully');
                return $app->redirect('/beacons');
            } else {
                var_dump('register');
            }
            var_dump($return);
            /*
            try {
                $prox->beacons->register($apiBeacon);
            } catch (\Google_Service_Exception $e) {
                var_dump($e->getErrors());
            }
            */
            die();


            $beacon['user_id'] = $this->getAuth($app)->authenticatedUser()['id'];

            if ($this->getBeaconService($app)->create($beacon)) {

                $app->success('Beacon created successfully.');
                return $app->redirect('/beacons');
            }
        }

        return $app->render('beacons/detail.html.twig', []);
    }
}