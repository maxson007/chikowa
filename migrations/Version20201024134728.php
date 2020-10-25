<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024134728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, type_entite VARCHAR(100) NOT NULL, localisation VARCHAR(255) NOT NULL, place_id VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_chikowa_user (association_id VARCHAR(255) NOT NULL, chikowa_user_id VARCHAR(255) NOT NULL, INDEX IDX_756488A6EFB9C8A5 (association_id), INDEX IDX_756488A6C11721AB (chikowa_user_id), PRIMARY KEY(association_id, chikowa_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_membre (association_id VARCHAR(255) NOT NULL, membre_id VARCHAR(255) NOT NULL, INDEX IDX_C5C0CE5EEFB9C8A5 (association_id), INDEX IDX_C5C0CE5E6A99F74A (membre_id), PRIMARY KEY(association_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chikowa_user (id VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, phone_number VARCHAR(20) NOT NULL, user_name VARCHAR(100) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C8F2EE2BE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, telephone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_tontine (membre_id VARCHAR(255) NOT NULL, tontine_id VARCHAR(255) NOT NULL, INDEX IDX_8D3149C26A99F74A (membre_id), INDEX IDX_8D3149C2DEB5C9FD (tontine_id), PRIMARY KEY(membre_id, tontine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tontine (id VARCHAR(255) NOT NULL, organisateur_id VARCHAR(255) DEFAULT NULL, libelle VARCHAR(100) NOT NULL, montant_par_membre DOUBLE PRECISION NOT NULL, frequence_paiement VARCHAR(20) NOT NULL, INDEX IDX_3F164B7FD936B2FA (organisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE association_chikowa_user ADD CONSTRAINT FK_756488A6EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_chikowa_user ADD CONSTRAINT FK_756488A6C11721AB FOREIGN KEY (chikowa_user_id) REFERENCES chikowa_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_membre ADD CONSTRAINT FK_C5C0CE5EEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE association_membre ADD CONSTRAINT FK_C5C0CE5E6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_tontine ADD CONSTRAINT FK_8D3149C26A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_tontine ADD CONSTRAINT FK_8D3149C2DEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES chikowa_user (id)');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FD936B2FA FOREIGN KEY (organisateur_id) REFERENCES tontine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE association_chikowa_user DROP FOREIGN KEY FK_756488A6EFB9C8A5');
        $this->addSql('ALTER TABLE association_membre DROP FOREIGN KEY FK_C5C0CE5EEFB9C8A5');
        $this->addSql('ALTER TABLE association_chikowa_user DROP FOREIGN KEY FK_756488A6C11721AB');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE association_membre DROP FOREIGN KEY FK_C5C0CE5E6A99F74A');
        $this->addSql('ALTER TABLE membre_tontine DROP FOREIGN KEY FK_8D3149C26A99F74A');
        $this->addSql('ALTER TABLE membre_tontine DROP FOREIGN KEY FK_8D3149C2DEB5C9FD');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FD936B2FA');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE association_chikowa_user');
        $this->addSql('DROP TABLE association_membre');
        $this->addSql('DROP TABLE chikowa_user');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE membre_tontine');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tontine');
    }
}
