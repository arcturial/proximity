<?php
namespace App\Controller;

use App\Application;

use Arcturial\Kontakt\KontaktClient;
use Arcturial\Kontakt\Resource\ChangeLog;

class IndexController
{
    /*
    private function getChangeLog()
    {
        $kontakt = new KontaktClient("OdhHaEEqrJlatVRxAGWXcavwQxvsMhdX", 8);
        $changeLog = new ChangeLog($kontakt);

        return $changeLog->beacon(strtotime('-1week'));
    }
    */

	public function indexAction(Application $app)
	{
        //var_dump($this->getChangeLog());

		return $app->render('index.html.twig', []);
	}
}