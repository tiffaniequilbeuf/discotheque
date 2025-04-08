<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408143414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE event_materiel (id INT AUTO_INCREMENT NOT NULL, materiel_id INT DEFAULT NULL, programmation_id INT DEFAULT NULL, date_reservation DATETIME NOT NULL, INDEX IDX_5E3E594116880AAF (materiel_id), INDEX IDX_5E3E594196D6BD09 (programmation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_materiel ADD CONSTRAINT FK_5E3E594116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_materiel ADD CONSTRAINT FK_5E3E594196D6BD09 FOREIGN KEY (programmation_id) REFERENCES programmation (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event_materiel DROP FOREIGN KEY FK_5E3E594116880AAF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_materiel DROP FOREIGN KEY FK_5E3E594196D6BD09
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event_materiel
        SQL);
    }
}
