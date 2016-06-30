<?php
namespace Proximity;

class User
{
    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }
}