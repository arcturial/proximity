<?php
namespace App;

class Persister
{
    public function create($db, $table, $object)
    {
        $index = 0;

        $statement = $db
            ->createQueryBuilder()
            ->insert($table);

        foreach ($object->getProperties() as $key => $value) {
            $statement->setValue($key, '?');
            $statement->setParameter($index++, $value);
        }

        return $statement->execute();
    }
}