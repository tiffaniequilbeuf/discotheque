<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408132829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE artist_programmation (artist_id INT NOT NULL, programmation_id INT NOT NULL, INDEX IDX_C3A566A2B7970CF8 (artist_id), INDEX IDX_C3A566A296D6BD09 (programmation_id), PRIMARY KEY(artist_id, programmation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE artist_programmation ADD CONSTRAINT FK_C3A566A2B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE artist_programmation ADD CONSTRAINT FK_C3A566A296D6BD09 FOREIGN KEY (programmation_id) REFERENCES programmation (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE artist_programmation DROP FOREIGN KEY FK_C3A566A2B7970CF8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE artist_programmation DROP FOREIGN KEY FK_C3A566A296D6BD09
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE artist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE artist_programmation
        SQL);
    }
}
