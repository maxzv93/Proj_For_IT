<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806170131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4AA0373A76ED395');
        $this->addSql('DROP INDEX IDX_4AA037394A4C7D4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__device_user AS SELECT device_id, user_id FROM device_user');
        $this->addSql('DROP TABLE device_user');
        $this->addSql('CREATE TABLE device_user (device_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(device_id, user_id), CONSTRAINT FK_4AA037394A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4AA0373A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO device_user (device_id, user_id) SELECT device_id, user_id FROM __temp__device_user');
        $this->addSql('DROP TABLE __temp__device_user');
        $this->addSql('CREATE INDEX IDX_4AA0373A76ED395 ON device_user (user_id)');
        $this->addSql('CREATE INDEX IDX_4AA037394A4C7D4 ON device_user (device_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4AA037394A4C7D4');
        $this->addSql('DROP INDEX IDX_4AA0373A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__device_user AS SELECT device_id, user_id FROM device_user');
        $this->addSql('DROP TABLE device_user');
        $this->addSql('CREATE TABLE device_user (device_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(device_id, user_id))');
        $this->addSql('INSERT INTO device_user (device_id, user_id) SELECT device_id, user_id FROM __temp__device_user');
        $this->addSql('DROP TABLE __temp__device_user');
        $this->addSql('CREATE INDEX IDX_4AA037394A4C7D4 ON device_user (device_id)');
        $this->addSql('CREATE INDEX IDX_4AA0373A76ED395 ON device_user (user_id)');
    }
}
