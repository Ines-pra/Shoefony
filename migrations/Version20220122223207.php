<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220122223207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sto_image_id (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE image_id');
        $this->addSql('DROP INDEX UNIQ_B21FD4303DA5256D ON sto_product');
        $this->addSql('ALTER TABLE sto_product CHANGE image_id sto_image_id INT NOT NULL');
        $this->addSql('ALTER TABLE sto_product ADD CONSTRAINT FK_B21FD430B37A9F44 FOREIGN KEY (sto_image_id) REFERENCES sto_image_id (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B21FD430B37A9F44 ON sto_product (sto_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sto_product DROP FOREIGN KEY FK_B21FD430B37A9F44');
        $this->addSql('CREATE TABLE image_id (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, alt VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE sto_image_id');
        $this->addSql('DROP INDEX UNIQ_B21FD430B37A9F44 ON sto_product');
        $this->addSql('ALTER TABLE sto_product CHANGE sto_image_id image_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B21FD4303DA5256D ON sto_product (image_id)');
    }
}
