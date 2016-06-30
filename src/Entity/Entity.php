<?php
namespace App\Entity;

abstract class Entity implements \ArrayAccess
{
    protected $properties = [
    ];

    public function __construct($properties = [])
    {
        $this->properties = array_merge($this->properties, $properties);
    }

    public function offsetExists($offset)
    {
        return isset($this->properties[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->properties[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->properties[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->properties[$offset]);
    }

    public function __set($key, $value)
    {
        $this->properties[$key] = $value;
    }

    public function __get($key)
    {
        return $this->properties[$key];
    }

    public function getProperties()
    {
        return $this->properties;
    }
}