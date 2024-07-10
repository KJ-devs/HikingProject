<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710171003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, article_id_id INT DEFAULT NULL, content LONGTEXT NOT NULL, likes TINYINT(1) DEFAULT NULL, likes_count INT DEFAULT NULL, INDEX IDX_5F9E962A8F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hikings (id INT AUTO_INCREMENT NOT NULL, article_id_id INT DEFAULT NULL, starting_point VARCHAR(255) NOT NULL, end_point VARCHAR(255) NOT NULL, kilometer DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_3FB46778F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, article_id_id INT DEFAULT NULL, size DOUBLE PRECISION NOT NULL, INDEX IDX_14B784188F3EC46 (article_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A8F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE hikings ADD CONSTRAINT FK_3FB46778F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188F3EC46 FOREIGN KEY (article_id_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A8F3EC46');
        $this->addSql('ALTER TABLE hikings DROP FOREIGN KEY FK_3FB46778F3EC46');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188F3EC46');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE hikings');
        $this->addSql('DROP TABLE photo');
    }
}
