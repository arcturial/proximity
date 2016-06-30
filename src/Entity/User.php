<?php
namespace App\Entity;

class User implements \ArrayAccess
{
    protected $properties = [
    ];

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

    public function verifyPassword($password)
    {
        return password_verify($password, $this->properties['password']);
    }

    public function getProperties()
    {
        return [
            'email' => 'test@test.com',
            'password' => password_hash('test', PASSWORD_BCRYPT)
        ];
    }
}