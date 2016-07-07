<?php
namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Creates the user table schema
 */
class VersionSetup extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->createTable('users');
        $table->addOption('engine', 'InnoDB');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('email', 'string', ['notnull' => true, 'length' => 255]);
        $table->addColumn('password', 'string', ['notnull' => true, 'length' => 255]);
        $table->addColumn('fname', 'string', ['notnull' => true, 'length' => 255]);
        $table->addColumn('sname', 'string', ['notnull' => true, 'length' => 255]);

        $table->setPrimaryKey(['id']);



        $table = $schema->createTable('beacons');
        $table->addOption('engine', 'InnoDB');

        $table->addColumn('name', 'string', ['notnull' => true, 'length' => 255]);
        $table->addColumn('user_id', 'integer', ['notnull' => true]);

        $table->setPrimaryKey(['name']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('users');
        $schema->dropTable('beacons');
    }
}
