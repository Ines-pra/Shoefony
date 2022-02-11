<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211174206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sto_comment DROP FOREIGN KEY FK_F52182F1DE18E50B');
        $this->addSql('DROP INDEX IDX_F52182F1DE18E50B ON sto_comment');
        $this->addSql('ALTER TABLE sto_comment CHANGE product_id_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE sto_comment ADD CONSTRAINT FK_F52182F14584665A FOREIGN KEY (product_id) REFERENCES sto_product (id)');
        $this->addSql('CREATE INDEX IDX_F52182F14584665A ON sto_comment (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sto_comment DROP FOREIGN KEY FK_F52182F14584665A');
        $this->addSql('DROP INDEX IDX_F52182F14584665A ON sto_comment');
        $this->addSql('ALTER TABLE sto_comment CHANGE product_id product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE sto_comment ADD CONSTRAINT FK_F52182F1DE18E50B FOREIGN KEY (product_id_id) REFERENCES sto_product (id)');
        $this->addSql('CREATE INDEX IDX_F52182F1DE18E50B ON sto_comment (product_id_id)');
    }
}
