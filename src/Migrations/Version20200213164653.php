<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213164653 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, annee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_de_classe (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, annee DATE NOT NULL, contenu LONGBLOB NOT NULL, INDEX IDX_99ABBB938F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo_de_classe ADD CONSTRAINT FK_99ABBB938F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE enfant ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA28F5EA509 ON enfant (classe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA28F5EA509');
        $this->addSql('ALTER TABLE photo_de_classe DROP FOREIGN KEY FK_99ABBB938F5EA509');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE photo_de_classe');
        $this->addSql('DROP INDEX IDX_34B70CA28F5EA509 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP classe_id');
    }
}
