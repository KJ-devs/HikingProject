<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240908191051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE followers (id INT AUTO_INCREMENT NOT NULL, number_follower INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE followers_user (followers_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3741275915BF9993 (followers_id), INDEX IDX_37412759A76ED395 (user_id), PRIMARY KEY(followers_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_DB021E96F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE password_reset_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(64) NOT NULL, expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C5D0A95AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_details (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, surname VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, profil_photo LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_2A2B15809D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_3741275915BF9993 FOREIGN KEY (followers_id) REFERENCES followers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_37412759A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE password_reset_request ADD CONSTRAINT FK_C5D0A95AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B15809D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE hikings ADD CONSTRAINT FK_3FB46778F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784187294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) DEFAULT 0 NOT NULL, ADD verification_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A8F3EC46');
        $this->addSql('ALTER TABLE hikings DROP FOREIGN KEY FK_3FB46778F3EC46');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D8F3EC46');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784187294869C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE followers_user DROP FOREIGN KEY FK_3741275915BF9993');
        $this->addSql('ALTER TABLE followers_user DROP FOREIGN KEY FK_37412759A76ED395');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F675F31B');
        $this->addSql('ALTER TABLE password_reset_request DROP FOREIGN KEY FK_C5D0A95AA76ED395');
        $this->addSql('ALTER TABLE user_details DROP FOREIGN KEY FK_2A2B15809D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE followers_user');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE password_reset_request');
        $this->addSql('DROP TABLE user_details');
        $this->addSql('ALTER TABLE user DROP is_verified, DROP verification_token');
    }
}
