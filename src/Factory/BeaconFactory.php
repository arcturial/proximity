<?php
namespace App\Factory;

class BeaconFactory
{
    public static function createEddystone($data)
    {
        return new \App\Entity\Beacon($data);
    }

    public static function create($data)
    {
        $type = isset($data['type']) ? $data['type'] : 'EDDYSTONE';

        return call_user_func_array(array($this, 'create' . $type) [$data]);
    }
}