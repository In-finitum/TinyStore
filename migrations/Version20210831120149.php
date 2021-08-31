<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210831120149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E92D487ED4D');
        $this->addSql('DROP INDEX IDX_6C844E92D487ED4D ON good');
        $this->addSql('ALTER TABLE good CHANGE idcategory_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_6C844E9212469DE2 ON good (category_id)');
        $this->addSql('ALTER TABLE good_order DROP FOREIGN KEY FK_EB8A3D4C274A2535');
        $this->addSql('ALTER TABLE good_order DROP FOREIGN KEY FK_EB8A3D4CC3FDDE1E');
        $this->addSql('DROP INDEX IDX_EB8A3D4C274A2535 ON good_order');
        $this->addSql('DROP INDEX IDX_EB8A3D4CC3FDDE1E ON good_order');
        $this->addSql('ALTER TABLE good_order ADD good_id INT NOT NULL, ADD order_id INT NOT NULL, DROP idgood_id, DROP idorder_id');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4C1CF98C70 FOREIGN KEY (good_id) REFERENCES good (id)');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4C8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_EB8A3D4C1CF98C70 ON good_order (good_id)');
        $this->addSql('CREATE INDEX IDX_EB8A3D4C8D9F6D38 ON good_order (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E9212469DE2');
        $this->addSql('DROP INDEX IDX_6C844E9212469DE2 ON good');
        $this->addSql('ALTER TABLE good CHANGE category_id idcategory_id INT NOT NULL');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E92D487ED4D FOREIGN KEY (idcategory_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6C844E92D487ED4D ON good (idcategory_id)');
        $this->addSql('ALTER TABLE good_order DROP FOREIGN KEY FK_EB8A3D4C1CF98C70');
        $this->addSql('ALTER TABLE good_order DROP FOREIGN KEY FK_EB8A3D4C8D9F6D38');
        $this->addSql('DROP INDEX IDX_EB8A3D4C1CF98C70 ON good_order');
        $this->addSql('DROP INDEX IDX_EB8A3D4C8D9F6D38 ON good_order');
        $this->addSql('ALTER TABLE good_order ADD idgood_id INT NOT NULL, ADD idorder_id INT NOT NULL, DROP good_id, DROP order_id');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4C274A2535 FOREIGN KEY (idorder_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE good_order ADD CONSTRAINT FK_EB8A3D4CC3FDDE1E FOREIGN KEY (idgood_id) REFERENCES good (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EB8A3D4C274A2535 ON good_order (idorder_id)');
        $this->addSql('CREATE INDEX IDX_EB8A3D4CC3FDDE1E ON good_order (idgood_id)');
    }
}
