<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522121846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE personnel_fonction_personnel');
        $this->addSql('ALTER TABLE personnel_fonction ADD personnel_id INT NOT NULL, ADD position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel_fonction ADD CONSTRAINT FK_A271CEF81C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('CREATE INDEX IDX_A271CEF81C109075 ON personnel_fonction (personnel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnel_fonction_personnel (personnel_fonction_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_2870153DAFED5C90 (personnel_fonction_id), INDEX IDX_2870153D1C109075 (personnel_id), PRIMARY KEY(personnel_fonction_id, personnel_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personnel_fonction_personnel ADD CONSTRAINT FK_2870153D1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_fonction_personnel ADD CONSTRAINT FK_2870153DAFED5C90 FOREIGN KEY (personnel_fonction_id) REFERENCES personnel_fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_fonction DROP FOREIGN KEY FK_A271CEF81C109075');
        $this->addSql('DROP INDEX IDX_A271CEF81C109075 ON personnel_fonction');
        $this->addSql('ALTER TABLE personnel_fonction DROP personnel_id, DROP position');
    }
}
