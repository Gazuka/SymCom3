<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514144502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_categ (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT DEFAULT NULL, INDEX IDX_9222E214CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_lien (id INT AUTO_INCREMENT NOT NULL, categ_id INT NOT NULL, titre VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, ordre INT DEFAULT NULL, INDEX IDX_6D7D44FBE8175B12 (categ_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_categ ADD CONSTRAINT FK_9222E214CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_lien ADD CONSTRAINT FK_6D7D44FBE8175B12 FOREIGN KEY (categ_id) REFERENCES menu_categ (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_categ DROP FOREIGN KEY FK_9222E214CCD7E912');
        $this->addSql('ALTER TABLE menu_lien DROP FOREIGN KEY FK_6D7D44FBE8175B12');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_categ');
        $this->addSql('DROP TABLE menu_lien');
    }
}
