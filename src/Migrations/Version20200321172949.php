<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321172949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date_created DATETIME NOT NULL, date_edited DATETIME NOT NULL, author VARCHAR(255) NOT NULL, is_published TINYINT(1) NOT NULL, INDEX IDX_1DD3995012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_article_image (news_id INT NOT NULL, article_image_id INT NOT NULL, INDEX IDX_E7691A08B5A459A0 (news_id), INDEX IDX_E7691A08684DD106 (article_image_id), PRIMARY KEY(news_id, article_image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_tag (news_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_BE3ED8A1B5A459A0 (news_id), INDEX IDX_BE3ED8A1BAD26311 (tag_id), PRIMARY KEY(news_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spiritual_pearls (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, date_created DATETIME NOT NULL, date_edited DATETIME NOT NULL, author VARCHAR(255) NOT NULL, is_publishes TINYINT(1) NOT NULL, INDEX IDX_9890724412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spiritual_pearls_article_image (spiritual_pearls_id INT NOT NULL, article_image_id INT NOT NULL, INDEX IDX_906C1548FCD46884 (spiritual_pearls_id), INDEX IDX_906C1548684DD106 (article_image_id), PRIMARY KEY(spiritual_pearls_id, article_image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spiritual_pearls_tag (spiritual_pearls_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_82744C41FCD46884 (spiritual_pearls_id), INDEX IDX_82744C41BAD26311 (tag_id), PRIMARY KEY(spiritual_pearls_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD3995012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE news_article_image ADD CONSTRAINT FK_E7691A08B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_article_image ADD CONSTRAINT FK_E7691A08684DD106 FOREIGN KEY (article_image_id) REFERENCES article_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_tag ADD CONSTRAINT FK_BE3ED8A1B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_tag ADD CONSTRAINT FK_BE3ED8A1BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spiritual_pearls ADD CONSTRAINT FK_9890724412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE spiritual_pearls_article_image ADD CONSTRAINT FK_906C1548FCD46884 FOREIGN KEY (spiritual_pearls_id) REFERENCES spiritual_pearls (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spiritual_pearls_article_image ADD CONSTRAINT FK_906C1548684DD106 FOREIGN KEY (article_image_id) REFERENCES article_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spiritual_pearls_tag ADD CONSTRAINT FK_82744C41FCD46884 FOREIGN KEY (spiritual_pearls_id) REFERENCES spiritual_pearls (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spiritual_pearls_tag ADD CONSTRAINT FK_82744C41BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE alias alias VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE news_article_image DROP FOREIGN KEY FK_E7691A08B5A459A0');
        $this->addSql('ALTER TABLE news_tag DROP FOREIGN KEY FK_BE3ED8A1B5A459A0');
        $this->addSql('ALTER TABLE spiritual_pearls_article_image DROP FOREIGN KEY FK_906C1548FCD46884');
        $this->addSql('ALTER TABLE spiritual_pearls_tag DROP FOREIGN KEY FK_82744C41FCD46884');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_article_image');
        $this->addSql('DROP TABLE news_tag');
        $this->addSql('DROP TABLE spiritual_pearls');
        $this->addSql('DROP TABLE spiritual_pearls_article_image');
        $this->addSql('DROP TABLE spiritual_pearls_tag');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE alias alias VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
