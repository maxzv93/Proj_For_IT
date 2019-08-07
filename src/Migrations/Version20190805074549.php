<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190805074549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE devicce');
        $this->addSql('ALTER TABLE device ADD COLUMN is_delete BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE devicce (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__device AS SELECT id, phone, model, producer, price, display, memory_size, ref_picture FROM device');
        $this->addSql('DROP TABLE device');
        $this->addSql('CREATE TABLE device (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, phone VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, producer VARCHAR(255) NOT NULL, price INTEGER NOT NULL, display DOUBLE PRECISION DEFAULT NULL, memory_size INTEGER DEFAULT NULL, ref_picture CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO device (id, phone, model, producer, price, display, memory_size, ref_picture) SELECT id, phone, model, producer, price, display, memory_size, ref_picture FROM __temp__device');
        $this->addSql('DROP TABLE __temp__device');
    }
}