<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710170048 extends AbstractMigration
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
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages_user (messages_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5F7E9CF4A5905F5A (messages_id), INDEX IDX_5F7E9CF4A76ED395 (user_id), PRIMARY KEY(messages_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_details (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, phone_number VARCHAR(15) DEFAULT NULL, surname VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, profil_photo LONGBLOB DEFAULT NULL, UNIQUE INDEX UNIQ_2A2B15809D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_3741275915BF9993 FOREIGN KEY (followers_id) REFERENCES followers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE followers_user ADD CONSTRAINT FK_37412759A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages_user ADD CONSTRAINT FK_5F7E9CF4A5905F5A FOREIGN KEY (messages_id) REFERENCES messages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages_user ADD CONSTRAINT FK_5F7E9CF4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_details ADD CONSTRAINT FK_2A2B15809D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE followers_user DROP FOREIGN KEY FK_3741275915BF9993');
        $this->addSql('ALTER TABLE followers_user DROP FOREIGN KEY FK_37412759A76ED395');
        $this->addSql('ALTER TABLE messages_user DROP FOREIGN KEY FK_5F7E9CF4A5905F5A');
        $this->addSql('ALTER TABLE messages_user DROP FOREIGN KEY FK_5F7E9CF4A76ED395');
        $this->addSql('ALTER TABLE user_details DROP FOREIGN KEY FK_2A2B15809D86650F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE followers_user');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE messages_user');
        $this->addSql('DROP TABLE user_details');
    }
}
