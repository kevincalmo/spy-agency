<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216183922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contacts ADD CONSTRAINT FK_33401573BE6CAE90 FOREIGN KEY (mission_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_33401573BE6CAE90 ON contacts (mission_id)');
        $this->addSql('ALTER TABLE missions ADD type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE targets ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE targets ADD CONSTRAINT FK_AF431E13BE6CAE90 FOREIGN KEY (mission_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_AF431E13BE6CAE90 ON targets (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP FOREIGN KEY FK_33401573BE6CAE90');
        $this->addSql('DROP INDEX IDX_33401573BE6CAE90 ON contacts');
        $this->addSql('ALTER TABLE contacts DROP mission_id');
        $this->addSql('ALTER TABLE missions DROP type');
        $this->addSql('ALTER TABLE targets DROP FOREIGN KEY FK_AF431E13BE6CAE90');
        $this->addSql('DROP INDEX IDX_AF431E13BE6CAE90 ON targets');
        $this->addSql('ALTER TABLE targets DROP mission_id');
    }
}
