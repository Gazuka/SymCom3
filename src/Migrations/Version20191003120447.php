<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003120447 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mission ADD association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('CREATE INDEX IDX_9067F23CEFB9C8A5 ON mission (association_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CEFB9C8A5');
        $this->addSql('DROP INDEX IDX_9067F23CEFB9C8A5 ON mission');
        $this->addSql('ALTER TABLE mission DROP association_id');
    }
}
