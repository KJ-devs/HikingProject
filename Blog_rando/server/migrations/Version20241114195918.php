<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114195918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE messages_id_seq CASCADE');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT fk_db021e96f675f31b');
        $this->addSql('DROP TABLE messages');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT fk_5f9e962a8f3ec46');
        $this->addSql('DROP INDEX idx_5f9e962a8f3ec46');
        $this->addSql('ALTER TABLE comments RENAME COLUMN article_id_id TO article_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5F9E962A7294869C ON comments (article_id)');
        $this->addSql('ALTER TABLE likes DROP CONSTRAINT fk_49ca4e7d8f3ec46');
        $this->addSql('DROP INDEX idx_49ca4e7d8f3ec46');
        $this->addSql('ALTER TABLE likes RENAME COLUMN article_id_id TO article_id');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_49CA4E7D7294869C ON likes (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE messages (id INT NOT NULL, author_id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_db021e96f675f31b ON messages (author_id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT fk_db021e96f675f31b FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE likes DROP CONSTRAINT FK_49CA4E7D7294869C');
        $this->addSql('DROP INDEX IDX_49CA4E7D7294869C');
        $this->addSql('ALTER TABLE likes RENAME COLUMN article_id TO article_id_id');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT fk_49ca4e7d8f3ec46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_49ca4e7d8f3ec46 ON likes (article_id_id)');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A7294869C');
        $this->addSql('DROP INDEX IDX_5F9E962A7294869C');
        $this->addSql('ALTER TABLE comments RENAME COLUMN article_id TO article_id_id');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT fk_5f9e962a8f3ec46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5f9e962a8f3ec46 ON comments (article_id_id)');
    }
}
