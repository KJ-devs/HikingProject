<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114201540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_details DROP CONSTRAINT fk_2a2b15809d86650f');
        $this->addSql('DROP INDEX uniq_2a2b15809d86650f');
        $this->addSql('ALTER TABLE user_details RENAME COLUMN user_id_id TO user_id');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B1580A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A2B1580A76ED395 ON user_details (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_details DROP CONSTRAINT FK_2A2B1580A76ED395');
        $this->addSql('DROP INDEX UNIQ_2A2B1580A76ED395');
        $this->addSql('ALTER TABLE user_details RENAME COLUMN user_id TO user_id_id');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT fk_2a2b15809d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_2a2b15809d86650f ON user_details (user_id_id)');
    }
}
