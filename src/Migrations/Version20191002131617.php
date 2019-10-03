<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002131617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE email_fonction');
        $this->addSql('DROP TABLE humain_fonction');
        $this->addSql('DROP TABLE telephone_fonction');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE email_fonction (email_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_266CAF4A832C1C9 (email_id), INDEX IDX_266CAF457889920 (fonction_id), PRIMARY KEY(email_id, fonction_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE humain_fonction (humain_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_EBFED5E11A10D012 (humain_id), INDEX IDX_EBFED5E157889920 (fonction_id), PRIMARY KEY(humain_id, fonction_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE telephone_fonction (telephone_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_DDB62DD0FE649A29 (telephone_id), INDEX IDX_DDB62DD057889920 (fonction_id), PRIMARY KEY(telephone_id, fonction_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE email_fonction ADD CONSTRAINT FK_266CAF457889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE email_fonction ADD CONSTRAINT FK_266CAF4A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE humain_fonction ADD CONSTRAINT FK_EBFED5E11A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE humain_fonction ADD CONSTRAINT FK_EBFED5E157889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_fonction ADD CONSTRAINT FK_DDB62DD057889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_fonction ADD CONSTRAINT FK_DDB62DD0FE649A29 FOREIGN KEY (telephone_id) REFERENCES telephone (id) ON DELETE CASCADE');
    }
}
