<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002131119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, humain_id INT DEFAULT NULL, structure_id INT DEFAULT NULL, fonction_id INT DEFAULT NULL, INDEX IDX_9067F23C1A10D012 (humain_id), INDEX IDX_9067F23C2534008B (structure_id), INDEX IDX_9067F23C57889920 (fonction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C1A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C57889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mission');
    }
}
