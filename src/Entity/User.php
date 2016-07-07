<?php
namespace App\Entity;

class User extends Entity
{
    protected $properties = [
        'id'        => 1,
        'email'     => 'test@test.com',
        'password'  => null,
        'fname'     => 'Chris',
        'sname'     => 'Brand'
    ];

    public function verifyPassword($password)
    {
        return true;
        return password_verify($password, $this->properties['password']);
    }

    public function getName()
    {
        return $this->properties['fname'] . ' ' . $this->properties['sname'];
    }

    public function getPassword()
    {
        return password_hash('test', PASSWORD_BCRYPT);
    }
}