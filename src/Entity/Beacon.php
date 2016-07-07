<?php
namespace App\Entity;

class Beacon extends Entity
{
    private static $google = null;

    protected $properties = [
        'name'              => null,
        'user_id'           => null,
        'namespace'         => null,
        'instanceId'        => null,
        'advertiserId'      => null,
        'advertiserType'    => null,
        'status'            => null
    ];

    private $googleData = [];

    public function getBeaconId()
    {
        return $this->properties['namespace'] . $this->properties['instanceId'];
    }

    public function getAdvertiserId()
    {
        return base64_encode(pack("H*", $this->getBeaconId()));
    }

    private function syncGoogle()
    {
        $prox = new \Google_Service_ProximityBeacon(static::$google);

        $data = $prox->beacons->get('beacons/3!' . $this->name);

        $this->googleData = $data;
    }

    public function getStatus()
    {
        $this->syncGoogle();
        return $this->googleData['status'];
    }

    public static function setGoogle($google)
    {
        static::$google = $google;
    }
}