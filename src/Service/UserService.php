<?php
namespace App\Service;

use Doctrine\DBAL\Driver\Connection;
use \PDO;

class UserService
{
    public function __construct(Connection $connection, \App\Persister $persister)
    {
        $this->persister = $persister;
        $this->connection = $connection;
    }

    public function fetchUserByEmail($email)
    {
        $statement = $this
            ->connection
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $email)
            ->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\User');

        return new \App\Entity\User;
        return $statement->fetch();
    }

    public function create(\App\Entity\User $user)
    {
        return $this->persister->create($this->connection, 'users', $user);
    }
}