<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170922040957 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tournament_leagues (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, slug VARCHAR(128) NOT NULL, title VARCHAR(255) NOT NULL, level INT NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_63531894989D9B62 (slug), INDEX IDX_635318944EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament_leagues ADD CONSTRAINT FK_635318944EC001D1 FOREIGN KEY (season_id) REFERENCES tournament_seasons (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tournament_leagues');
    }
}
