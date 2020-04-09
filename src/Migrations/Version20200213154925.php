<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213154925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant_user (enfant_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EBBCCE7E450D2529 (enfant_id), INDEX IDX_EBBCCE7EA76ED395 (user_id), PRIMARY KEY(enfant_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles TEXT NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enfant_user ADD CONSTRAINT FK_EBBCCE7E450D2529 FOREIGN KEY (enfant_id) REFERENCES enfant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enfant_user ADD CONSTRAINT FK_EBBCCE7EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enfant_user DROP FOREIGN KEY FK_EBBCCE7E450D2529');
        $this->addSql('ALTER TABLE enfant_user DROP FOREIGN KEY FK_EBBCCE7EA76ED395');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE enfant_user');
        $this->addSql('DROP TABLE user');
    }
}
