<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114194438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE followers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hikings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE likes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE password_reset_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE photo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('COMMENT ON COLUMN article.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE comments (id INT NOT NULL, article_id_id INT DEFAULT NULL, content TEXT NOT NULL, likes BOOLEAN DEFAULT NULL, likes_count INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A8F3EC46 ON comments (article_id_id)');
        $this->addSql('CREATE TABLE followers (id INT NOT NULL, number_follower INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE followers_user (followers_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(followers_id, user_id))');
        $this->addSql('CREATE INDEX IDX_3741275915BF9993 ON followers_user (followers_id)');
        $this->addSql('CREATE INDEX IDX_37412759A76ED395 ON followers_user (user_id)');
        $this->addSql('CREATE TABLE hikings (id INT NOT NULL, article_id_id INT DEFAULT NULL, starting_point VARCHAR(255) NOT NULL, end_point VARCHAR(255) NOT NULL, kilometer DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3FB46778F3EC46 ON hikings (article_id_id)');
        $this->addSql('CREATE TABLE likes (id INT NOT NULL, article_id_id INT DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_49CA4E7D8F3EC46 ON likes (article_id_id)');
        $this->addSql('CREATE TABLE messages (id INT NOT NULL, author_id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB021E96F675F31B ON messages (author_id)');
        $this->addSql('CREATE TABLE password_reset_request (id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(64) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5D0A95AA76ED395 ON password_reset_request (user_id)');
        $this->addSql('COMMENT ON COLUMN password_reset_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE photo (id INT NOT NULL, article_id INT DEFAULT NULL, size DOUBLE PRECISION NOT NULL, image_blob BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14B784187294869C ON photo (article_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN DEFAULT false NOT NULL, verification_token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_details (id INT NOT NULL, user_id_id INT NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, surname VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, profil_photo BYTEA DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A2B15809D86650F ON user_details (user_id_id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_3741275915BF9993 FOREIGN KEY (followers_id) REFERENCES followers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_37412759A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hikings ADD CONSTRAINT FK_3FB46778F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE password_reset_request ADD CONSTRAINT FK_C5D0A95AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784187294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B15809D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE followers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hikings_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE likes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE messages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE password_reset_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE photo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_details_id_seq CASCADE');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A8F3EC46');
        $this->addSql('ALTER TABLE followers_user DROP CONSTRAINT FK_3741275915BF9993');
        $this->addSql('ALTER TABLE followers_user DROP CONSTRAINT FK_37412759A76ED395');
        $this->addSql('ALTER TABLE hikings DROP CONSTRAINT FK_3FB46778F3EC46');
        $this->addSql('ALTER TABLE likes DROP CONSTRAINT FK_49CA4E7D8F3EC46');
        $this->addSql('ALTER TABLE messages DROP CONSTRAINT FK_DB021E96F675F31B');
        $this->addSql('ALTER TABLE password_reset_request DROP CONSTRAINT FK_C5D0A95AA76ED395');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B784187294869C');
        $this->addSql('ALTER TABLE user_details DROP CONSTRAINT FK_2A2B15809D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE followers_user');
        $this->addSql('DROP TABLE hikings');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE password_reset_request');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_details');
    }
}
