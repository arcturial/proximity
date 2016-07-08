<?php
namespace App\Entity;

class User extends Entity
{
    protected $fields = [
        'id',
        'email',
        'password',
        'fname',
        'sname'
    ];

    public function __construct(array $values = [])
    {
        parent::__construct([
            'id'        => 1,
            'email'     => 'test@test.com',
            'password'  => null,
            'fname'     => 'Chris',
            'sname'     => 'Brand'
        ]);
    }

    public function verifyPassword($password)
    {
        return true;
        return password_verify($password, $this->properties['password']);
    }

    public function getPassword()
    {
        return password_hash('test', PASSWORD_BCRYPT);
    }
}