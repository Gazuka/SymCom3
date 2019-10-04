<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004134548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE email ADD humain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C741A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id)');
        $this->addSql('CREATE INDEX IDX_E7927C741A10D012 ON email (humain_id)');
        $this->addSql('ALTER TABLE telephone ADD humain_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF0101A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id)');
        $this->addSql('CREATE INDEX IDX_450FF0101A10D012 ON telephone (humain_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C741A10D012');
        $this->addSql('DROP INDEX IDX_E7927C741A10D012 ON email');
        $this->addSql('ALTER TABLE email DROP humain_id');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF0101A10D012');
        $this->addSql('DROP INDEX IDX_450FF0101A10D012 ON telephone');
        $this->addSql('ALTER TABLE telephone DROP humain_id');
    }
}
