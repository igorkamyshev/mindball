<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171011162458 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adverts ADD season_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adverts ADD CONSTRAINT FK_8C88E7774EC001D1 FOREIGN KEY (season_id) REFERENCES tournament_seasons (id)');
        $this->addSql('CREATE INDEX IDX_8C88E7774EC001D1 ON adverts (season_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adverts DROP FOREIGN KEY FK_8C88E7774EC001D1');
        $this->addSql('DROP INDEX IDX_8C88E7774EC001D1 ON adverts');
        $this->addSql('ALTER TABLE adverts DROP season_id');
    }
}
