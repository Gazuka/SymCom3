<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190925141723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE humain ADD photo_id INT DEFAULT NULL, ADD adresse_id INT DEFAULT NULL, ADD sexe VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE humain ADD CONSTRAINT FK_FA3B51537E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE humain ADD CONSTRAINT FK_FA3B51534DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA3B51537E9E4C8C ON humain (photo_id)');
        $this->addSql('CREATE INDEX IDX_FA3B51534DE7DC5C ON humain (adresse_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE humain DROP FOREIGN KEY FK_FA3B51537E9E4C8C');
        $this->addSql('DROP TABLE photo');
        $this->addSql('ALTER TABLE humain DROP FOREIGN KEY FK_FA3B51534DE7DC5C');
        $this->addSql('DROP INDEX UNIQ_FA3B51537E9E4C8C ON humain');
        $this->addSql('DROP INDEX IDX_FA3B51534DE7DC5C ON humain');
        $this->addSql('ALTER TABLE humain DROP photo_id, DROP adresse_id, DROP sexe');
    }
}
