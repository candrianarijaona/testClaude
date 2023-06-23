<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623144459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clavier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecran (id INT AUTO_INCREMENT NOT NULL, marque_ecran_id INT NOT NULL, ordinateur_id INT DEFAULT NULL, taille INT NOT NULL, INDEX IDX_3FFAFD4A8A3277A3 (marque_ecran_id), INDEX IDX_3FFAFD4A828317CA (ordinateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque_ecran (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordinateur (id INT AUTO_INCREMENT NOT NULL, souris_id INT NOT NULL, tour_id INT NOT NULL, clavier_id INT NOT NULL, nom VARCHAR(255) NOT NULL, statut TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8712E8DBAAFE0C83 (souris_id), UNIQUE INDEX UNIQ_8712E8DB15ED8D43 (tour_id), UNIQUE INDEX UNIQ_8712E8DBD6EB321B (clavier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souris (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ecran ADD CONSTRAINT FK_3FFAFD4A8A3277A3 FOREIGN KEY (marque_ecran_id) REFERENCES marque_ecran (id)');
        $this->addSql('ALTER TABLE ecran ADD CONSTRAINT FK_3FFAFD4A828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateur (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBAAFE0C83 FOREIGN KEY (souris_id) REFERENCES souris (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DB15ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE ordinateur ADD CONSTRAINT FK_8712E8DBD6EB321B FOREIGN KEY (clavier_id) REFERENCES clavier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecran DROP FOREIGN KEY FK_3FFAFD4A8A3277A3');
        $this->addSql('ALTER TABLE ecran DROP FOREIGN KEY FK_3FFAFD4A828317CA');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBAAFE0C83');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DB15ED8D43');
        $this->addSql('ALTER TABLE ordinateur DROP FOREIGN KEY FK_8712E8DBD6EB321B');
        $this->addSql('DROP TABLE clavier');
        $this->addSql('DROP TABLE ecran');
        $this->addSql('DROP TABLE marque_ecran');
        $this->addSql('DROP TABLE ordinateur');
        $this->addSql('DROP TABLE souris');
        $this->addSql('DROP TABLE tour');
    }
}
