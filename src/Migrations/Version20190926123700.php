<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926123700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email_humain (email_id INT NOT NULL, humain_id INT NOT NULL, INDEX IDX_87A182A3A832C1C9 (email_id), INDEX IDX_87A182A31A10D012 (humain_id), PRIMARY KEY(email_id, humain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email_fonction (email_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_266CAF4A832C1C9 (email_id), INDEX IDX_266CAF457889920 (fonction_id), PRIMARY KEY(email_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone_humain (telephone_id INT NOT NULL, humain_id INT NOT NULL, INDEX IDX_5FDE0CD9FE649A29 (telephone_id), INDEX IDX_5FDE0CD91A10D012 (humain_id), PRIMARY KEY(telephone_id, humain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone_fonction (telephone_id INT NOT NULL, fonction_id INT NOT NULL, INDEX IDX_DDB62DD0FE649A29 (telephone_id), INDEX IDX_DDB62DD057889920 (fonction_id), PRIMARY KEY(telephone_id, fonction_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE email_humain ADD CONSTRAINT FK_87A182A3A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE email_humain ADD CONSTRAINT FK_87A182A31A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE email_fonction ADD CONSTRAINT FK_266CAF4A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE email_fonction ADD CONSTRAINT FK_266CAF457889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_humain ADD CONSTRAINT FK_5FDE0CD9FE649A29 FOREIGN KEY (telephone_id) REFERENCES telephone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_humain ADD CONSTRAINT FK_5FDE0CD91A10D012 FOREIGN KEY (humain_id) REFERENCES humain (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_fonction ADD CONSTRAINT FK_DDB62DD0FE649A29 FOREIGN KEY (telephone_id) REFERENCES telephone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE telephone_fonction ADD CONSTRAINT FK_DDB62DD057889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE email_humain DROP FOREIGN KEY FK_87A182A3A832C1C9');
        $this->addSql('ALTER TABLE email_fonction DROP FOREIGN KEY FK_266CAF4A832C1C9');
        $this->addSql('ALTER TABLE email_fonction DROP FOREIGN KEY FK_266CAF457889920');
        $this->addSql('ALTER TABLE telephone_fonction DROP FOREIGN KEY FK_DDB62DD057889920');
        $this->addSql('ALTER TABLE telephone_humain DROP FOREIGN KEY FK_5FDE0CD9FE649A29');
        $this->addSql('ALTER TABLE telephone_fonction DROP FOREIGN KEY FK_DDB62DD0FE649A29');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE email_humain');
        $this->addSql('DROP TABLE email_fonction');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE telephone');
        $this->addSql('DROP TABLE telephone_humain');
        $this->addSql('DROP TABLE telephone_fonction');
    }
}
