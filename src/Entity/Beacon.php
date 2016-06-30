<?php
namespace App\Entity;

class Beacon extends Entity
{
    const TYPES = [
        0   => 'Eddystone',
        1   => 'iBeacon'
    ];

    protected $properties = [
        'id'        => null,
        'user_id'   => null,
        'name'      => null,
        'type'      => 0,
        'uuid'      => null
    ];

    public function getTypeLabel()
    {
        return static::TYPES[$this['type']];
    }
}