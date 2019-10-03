<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926140503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE humain_fonction (humain_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_EBFED5E11A10D012 (humain_id), INDEX IDX_EBFED5E157889920 (fonction_id), PRIMARY KEY(humain_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE humain_fonction ADD CONSTRAINT FK_EBFED5E11A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE humain_fonction ADD CONSTRAINT FK_EBFED5E157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE humain_fonction');
    }
}
