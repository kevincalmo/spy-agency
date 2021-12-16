<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216181459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_speciality (missions_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_EA388C6E17C042CF (missions_id), INDEX IDX_EA388C6E3B5A08D7 (speciality_id), PRIMARY KEY(missions_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_speciality ADD CONSTRAINT FK_EA388C6E17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_speciality ADD CONSTRAINT FK_EA388C6E3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34F1D47E6BF700BD ON missions (status_id)');
        $this->addSql('ALTER TABLE stashs ADD missions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stashs ADD CONSTRAINT FK_81231F8517C042CF FOREIGN KEY (missions_id) REFERENCES missions (id)');
        $this->addSql('CREATE INDEX IDX_81231F8517C042CF ON stashs (missions_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_speciality');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E6BF700BD');
        $this->addSql('DROP INDEX UNIQ_34F1D47E6BF700BD ON missions');
        $this->addSql('ALTER TABLE missions DROP status_id');
        $this->addSql('ALTER TABLE stashs DROP FOREIGN KEY FK_81231F8517C042CF');
        $this->addSql('DROP INDEX IDX_81231F8517C042CF ON stashs');
        $this->addSql('ALTER TABLE stashs DROP missions_id');
    }
}
