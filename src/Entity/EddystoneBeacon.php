<?php
namespace App\Entity;

class EddystoneBeacon extends Beacon
{
    public function __construct(array $values = [])
    {
        $values['id'] = $values['namespace'] . $values['instanceId'];
        $values['type'] = 0;
        $values['status'] = 1;
        parent::__construct($values);
    }

    public function getAdvertiserId()
    {
        return base64_encode(pack("H*", $this->getBeaconId()));
    }
}