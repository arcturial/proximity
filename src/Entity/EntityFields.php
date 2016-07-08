<?php
namespace App\Entity;

class EntityFields
{
    private $fields = [];
    private $values = [];

    public function __construct($fields, $values)
    {
        $this->values = array_intersect_key($values, array_flip($fields));
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function fetch()
    {
        return $this->values;
    }
}