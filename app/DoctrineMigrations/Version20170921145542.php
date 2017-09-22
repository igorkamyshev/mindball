<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170921145542 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE areas (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(128) NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_58B0B25C989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournaments (id INT AUTO_INCREMENT NOT NULL, area_id INT DEFAULT NULL, slug VARCHAR(128) NOT NULL, title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E4BCFAC3989D9B62 (slug), INDEX IDX_E4BCFAC3BD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_seasons (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, slug VARCHAR(128) NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, UNIQUE INDEX UNIQ_DFFBCB16989D9B62 (slug), INDEX IDX_DFFBCB1633D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournaments ADD CONSTRAINT FK_E4BCFAC3BD0F409C FOREIGN KEY (area_id) REFERENCES areas (id)');
        $this->addSql('ALTER TABLE tournament_seasons ADD CONSTRAINT FK_DFFBCB1633D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournaments (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tournaments DROP FOREIGN KEY FK_E4BCFAC3BD0F409C');
        $this->addSql('ALTER TABLE tournament_seasons DROP FOREIGN KEY FK_DFFBCB1633D1A3E7');
        $this->addSql('DROP TABLE areas');
        $this->addSql('DROP TABLE tournaments');
        $this->addSql('DROP TABLE tournament_seasons');
    }
}
