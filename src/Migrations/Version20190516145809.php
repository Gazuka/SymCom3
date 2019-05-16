<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516145809 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_fonction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, structure VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_fonction_personnel (personnel_fonction_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_2870153DAFED5C90 (personnel_fonction_id), INDEX IDX_2870153D1C109075 (personnel_id), PRIMARY KEY(personnel_fonction_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_mail (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_mail_personnel (personnel_mail_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_906DA5896851732E (personnel_mail_id), INDEX IDX_906DA5891C109075 (personnel_id), PRIMARY KEY(personnel_mail_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_telephone (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel_telephone_personnel (personnel_telephone_id INT NOT NULL, personnel_id INT NOT NULL, INDEX IDX_FDC5BB3D35FD4C60 (personnel_telephone_id), INDEX IDX_FDC5BB3D1C109075 (personnel_id), PRIMARY KEY(personnel_telephone_id, personnel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnel_fonction_personnel ADD CONSTRAINT FK_2870153DAFED5C90 FOREIGN KEY (personnel_fonction_id) REFERENCES personnel_fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_fonction_personnel ADD CONSTRAINT FK_2870153D1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_mail_personnel ADD CONSTRAINT FK_906DA5896851732E FOREIGN KEY (personnel_mail_id) REFERENCES personnel_mail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_mail_personnel ADD CONSTRAINT FK_906DA5891C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_telephone_personnel ADD CONSTRAINT FK_FDC5BB3D35FD4C60 FOREIGN KEY (personnel_telephone_id) REFERENCES personnel_telephone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnel_telephone_personnel ADD CONSTRAINT FK_FDC5BB3D1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnel_fonction_personnel DROP FOREIGN KEY FK_2870153D1C109075');
        $this->addSql('ALTER TABLE personnel_mail_personnel DROP FOREIGN KEY FK_906DA5891C109075');
        $this->addSql('ALTER TABLE personnel_telephone_personnel DROP FOREIGN KEY FK_FDC5BB3D1C109075');
        $this->addSql('ALTER TABLE personnel_fonction_personnel DROP FOREIGN KEY FK_2870153DAFED5C90');
        $this->addSql('ALTER TABLE personnel_mail_personnel DROP FOREIGN KEY FK_906DA5896851732E');
        $this->addSql('ALTER TABLE personnel_telephone_personnel DROP FOREIGN KEY FK_FDC5BB3D35FD4C60');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE personnel_fonction');
        $this->addSql('DROP TABLE personnel_fonction_personnel');
        $this->addSql('DROP TABLE personnel_mail');
        $this->addSql('DROP TABLE personnel_mail_personnel');
        $this->addSql('DROP TABLE personnel_telephone');
        $this->addSql('DROP TABLE personnel_telephone_personnel');
    }
}
