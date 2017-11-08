<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171108105955 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seasons_images (season_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_928C87AE4EC001D1 (season_id), UNIQUE INDEX UNIQ_928C87AE3DA5256D (image_id), PRIMARY KEY(season_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seasons_images ADD CONSTRAINT FK_928C87AE4EC001D1 FOREIGN KEY (season_id) REFERENCES tournament_seasons (id)');
        $this->addSql('ALTER TABLE seasons_images ADD CONSTRAINT FK_928C87AE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE seasons_images DROP FOREIGN KEY FK_928C87AE3DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE seasons_images');
    }
}
