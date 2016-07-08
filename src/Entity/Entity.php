<?php
namespace App\Entity;

abstract class Entity
{
    protected $fields = null;
    private $values = null;

    public function __construct(array $values = [])
    {
        $this->values = new EntityFields($this->fields, $values);
    }

    public function __set($key, $value)
    {
        $this->values->$key = $value;
    }

    public function __get($key)
    {
        return $this->values->$key;
    }

    public function getValues()
    {
        return $this->values->fetch();
    }
}