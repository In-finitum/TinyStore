<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210829160403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, iduser_id INT NOT NULL, addingdate DATETIME NOT NULL, buyingdate DATETIME DEFAULT NULL, INDEX IDX_F5299398786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE good_order ADD idorder_id INT NOT NULL');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4C274A2535 FOREIGN KEY (idorder_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_EB8A3D4C274A2535 ON good_order (idorder_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good_order DROP FOREIGN KEY FK_EB8A3D4C274A2535');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398786A81FB');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_EB8A3D4C274A2535 ON good_order');
        $this->addSql('ALTER TABLE good_order DROP idorder_id');
    }
}
