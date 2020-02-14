<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214083318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carnet_de_correspondance (id INT AUTO_INCREMENT NOT NULL, enfant_id INT DEFAULT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_D05D65FE450D2529 (enfant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objet_carnet (id INT AUTO_INCREMENT NOT NULL, carnet_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_E2B2CB7AFA207516 (carnet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carnet_de_correspondance ADD CONSTRAINT FK_D05D65FE450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id)');
        $this->addSql('ALTER TABLE objet_carnet ADD CONSTRAINT FK_E2B2CB7AFA207516 FOREIGN KEY (carnet_id) REFERENCES carnet_de_correspondance (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE objet_carnet DROP FOREIGN KEY FK_E2B2CB7AFA207516');
        $this->addSql('DROP TABLE carnet_de_correspondance');
        $this->addSql('DROP TABLE objet_carnet');
    }
}
