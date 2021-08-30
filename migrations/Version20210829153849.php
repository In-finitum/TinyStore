<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210829153849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE good_order (id INT AUTO_INCREMENT NOT NULL, idgood_id INT NOT NULL, price INT NOT NULL, amount INT NOT NULL, INDEX IDX_EB8A3D4CC3FDDE1E (idgood_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4CC3FDDE1E FOREIGN KEY (idgood_id) REFERENCES good (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE good_order');
    }
}
