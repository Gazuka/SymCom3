<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529133355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_start DATETIME DEFAULT NULL, date_stop DATETIME DEFAULT NULL, publie TINYINT(1) NOT NULL, archive TINYINT(1) NOT NULL, accueil TINYINT(1) NOT NULL, image_intro VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_content (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, position INT NOT NULL, INDEX IDX_1317741E7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_content_card (id INT AUTO_INCREMENT NOT NULL, article_content_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_83A0287B879726C (article_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_content ADD CONSTRAINT FK_1317741E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_content_card ADD CONSTRAINT FK_83A0287B879726C FOREIGN KEY (article_content_id) REFERENCES article_content (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_content DROP FOREIGN KEY FK_1317741E7294869C');
        $this->addSql('ALTER TABLE article_content_card DROP FOREIGN KEY FK_83A0287B879726C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_content');
        $this->addSql('DROP TABLE article_content_card');
    }
}
