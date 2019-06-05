<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605142648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_content_jumbo (id INT AUTO_INCREMENT NOT NULL, article_content_id INT NOT NULL, titre VARCHAR(255) NOT NULL, titre_visibility TINYINT(1) NOT NULL, contenu LONGTEXT DEFAULT NULL, intro LONGTEXT DEFAULT NULL, position INT NOT NULL, nbr_col_sm INT NOT NULL, nbr_col_md INT NOT NULL, nbr_col_lg INT NOT NULL, nbr_col_xl INT NOT NULL, INDEX IDX_EF905EB7B879726C (article_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_content_jumbo ADD CONSTRAINT FK_EF905EB7B879726C FOREIGN KEY (article_content_id) REFERENCES article_content (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_content_jumbo');
    }
}
