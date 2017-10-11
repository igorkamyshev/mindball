<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171011161255 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adverts ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adverts ADD CONSTRAINT FK_8C88E777F675F31B FOREIGN KEY (author_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_8C88E777F675F31B ON adverts (author_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adverts DROP FOREIGN KEY FK_8C88E777F675F31B');
        $this->addSql('DROP INDEX IDX_8C88E777F675F31B ON adverts');
        $this->addSql('ALTER TABLE adverts DROP author_id');
    }
}
