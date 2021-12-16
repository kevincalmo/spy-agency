<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216175757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agents ADD CONSTRAINT FK_9596AB6EBE6CAE90 FOREIGN KEY (mission_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_9596AB6EBE6CAE90 ON agents (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agents DROP FOREIGN KEY FK_9596AB6EBE6CAE90');
        $this->addSql('DROP INDEX IDX_9596AB6EBE6CAE90 ON agents');
        $this->addSql('ALTER TABLE agents DROP mission_id');
    }
}
