<?php
namespace App\Service;

use Doctrine\DBAL\Driver\Connection;
use \PDO;

class BeaconService
{
    public function __construct(Connection $connection, \App\Persister $persister)
    {
        $this->persister = $persister;
        $this->connection = $connection;
    }

    public function fetchBeaconsByUserId($userId, $paging)
    {
        $query = $this
            ->connection
            ->createQueryBuilder()
            ->select('*')
            ->from('beacons')
            ->where('user_id = ?')
            ->setParameter(0, $userId)
            ->setFirstResult($paging->getPage() * $paging->getOffset())
            ->setMaxResults($paging->getOffset());

        $statement = $query->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\Beacon');

        $result = $statement->fetchAll();

        // Total rows
        $rows = $query
            ->select('COUNT(DISTINCT id) AS rows')
            ->setFirstResult(null)
            ->setMaxResults(null)
            ->execute()
            ->fetchColumn();

        return new \App\PaginatedResult($result, $paging, $rows);
    }

    public function create(\App\Entity\Beacon $user)
    {
        return $this->persister->create($this->connection, 'beacons', $user);
    }
}