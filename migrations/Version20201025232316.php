<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025232316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tontine ADD association_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FEFB9C8A5 ON tontine (association_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FEFB9C8A5');
        $this->addSql('DROP INDEX IDX_3F164B7FEFB9C8A5 ON tontine');
        $this->addSql('ALTER TABLE tontine DROP association_id');
    }
}
