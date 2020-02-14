<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214075524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE enfant_classe (enfant_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_CECE1DB450D2529 (enfant_id), INDEX IDX_CECE1DB8F5EA509 (classe_id), PRIMARY KEY(enfant_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enfant_classe ADD CONSTRAINT FK_CECE1DB450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_classe ADD CONSTRAINT FK_CECE1DB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA28F5EA509');
        $this->addSql('DROP INDEX IDX_34B70CA28F5EA509 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP classe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE enfant_classe');
        $this->addSql('ALTER TABLE classe DROP nom');
        $this->addSql('ALTER TABLE enfant ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_34B70CA28F5EA509 ON enfant (classe_id)');
    }
}
