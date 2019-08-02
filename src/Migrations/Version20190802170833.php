<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802170833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE device ADD COLUMN ref_picture CLOB DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__device AS SELECT id, phone, model, producer, price, display, memory_size FROM device');
        $this->addSql('DROP TABLE device');
        $this->addSql('CREATE TABLE device (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, phone VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, producer VARCHAR(255) NOT NULL, price INTEGER NOT NULL, display DOUBLE PRECISION DEFAULT NULL, memory_size INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO device (id, phone, model, producer, price, display, memory_size) SELECT id, phone, model, producer, price, display, memory_size FROM __temp__device');
        $this->addSql('DROP TABLE __temp__device');
    }
}
