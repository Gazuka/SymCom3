<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190511082250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agenda (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agenda_agenda_event (agenda_id INT NOT NULL, agenda_event_id INT NOT NULL, INDEX IDX_1922E55CEA67784A (agenda_id), INDEX IDX_1922E55C70AF5DEF (agenda_event_id), PRIMARY KEY(agenda_id, agenda_event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agenda_event (id INT AUTO_INCREMENT NOT NULL, date_event DATE NOT NULL, nom VARCHAR(255) NOT NULL, lieu VARCHAR(255) DEFAULT NULL, heure_debut TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, date_publication DATE DEFAULT NULL, publie TINYINT(1) NOT NULL, lien VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agenda_agenda_event ADD CONSTRAINT FK_1922E55CEA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agenda_agenda_event ADD CONSTRAINT FK_1922E55C70AF5DEF FOREIGN KEY (agenda_event_id) REFERENCES agenda_event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agenda_agenda_event DROP FOREIGN KEY FK_1922E55CEA67784A');
        $this->addSql('ALTER TABLE agenda_agenda_event DROP FOREIGN KEY FK_1922E55C70AF5DEF');
        $this->addSql('DROP TABLE agenda');
        $this->addSql('DROP TABLE agenda_agenda_event');
        $this->addSql('DROP TABLE agenda_event');
    }
}
