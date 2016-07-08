<?php
namespace App\Entity;

class Beacon extends Entity
{
    protected $fields = [
        'id',
        'user_id',
        'type',
        'status',
        'description'
    ];
}