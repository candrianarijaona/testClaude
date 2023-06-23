<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623161337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordinateur_ecran (ordinateur_id INT NOT NULL, ecran_id INT NOT NULL, INDEX IDX_CBF5E335828317CA (ordinateur_id), INDEX IDX_CBF5E335E73649EB (ecran_id), PRIMARY KEY(ordinateur_id, ecran_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordinateur_ecran ADD CONSTRAINT FK_CBF5E335828317CA FOREIGN KEY (ordinateur_id) REFERENCES ordinateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordinateur_ecran ADD CONSTRAINT FK_CBF5E335E73649EB FOREIGN KEY (ecran_id) REFERENCES ecran (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ordinateur_ecran DROP FOREIGN KEY FK_CBF5E335828317CA');
        $this->addSql('ALTER TABLE ordinateur_ecran DROP FOREIGN KEY FK_CBF5E335E73649EB');
        $this->addSql('DROP TABLE ordinateur_ecran');
    }
}
