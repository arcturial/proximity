<?php
namespace App\Factory;

class BeaconFactory
{
    const TYPE_MAP = [
        0 => 'App\Entity\EddystoneBeacon'
    ];

    public static function create($data)
    {
        $type = isset($data['type']) ? $data['type'] : 0;
        $typeClass = static::TYPE_MAP[$type];

        return new $typeClass($data);
    }
}