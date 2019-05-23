<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523144443 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horaire_ouverture ADD horaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE horaire_ouverture ADD CONSTRAINT FK_D97D249558C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('CREATE INDEX IDX_D97D249558C54515 ON horaire_ouverture (horaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE horaire_ouverture DROP FOREIGN KEY FK_D97D249558C54515');
        $this->addSql('DROP INDEX IDX_D97D249558C54515 ON horaire_ouverture');
        $this->addSql('ALTER TABLE horaire_ouverture DROP horaire_id');
    }
}
