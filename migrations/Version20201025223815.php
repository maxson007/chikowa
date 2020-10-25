<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025223815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE membre_tontine');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FD936B2FA');
        $this->addSql('DROP INDEX IDX_3F164B7FD936B2FA ON tontine');
        $this->addSql('ALTER TABLE tontine ADD date_debut DATE NOT NULL, DROP organisateur_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membre_tontine (membre_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tontine_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8D3149C2DEB5C9FD (tontine_id), INDEX IDX_8D3149C26A99F74A (membre_id), PRIMARY KEY(membre_id, tontine_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE membre_tontine ADD CONSTRAINT FK_8D3149C26A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_tontine ADD CONSTRAINT FK_8D3149C2DEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tontine ADD organisateur_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP date_debut');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FD936B2FA FOREIGN KEY (organisateur_id) REFERENCES tontine (id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FD936B2FA ON tontine (organisateur_id)');
    }
}
