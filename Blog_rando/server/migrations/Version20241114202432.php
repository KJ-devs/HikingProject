<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114202432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_details_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_details DROP CONSTRAINT fk_2a2b1580a76ed395');
        $this->addSql('DROP TABLE user_details');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_details (id INT NOT NULL, user_id INT NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, surname VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, profil_photo BYTEA DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_2a2b1580a76ed395 ON user_details (user_id)');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT fk_2a2b1580a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
