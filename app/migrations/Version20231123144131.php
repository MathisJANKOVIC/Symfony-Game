<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123144131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, liked TINYINT(1) NOT NULL, score INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score_user (score_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A78B573F12EB0A51 (score_id), INDEX IDX_A78B573FA76ED395 (user_id), PRIMARY KEY(score_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score_word (score_id INT NOT NULL, word_id INT NOT NULL, INDEX IDX_E9E9F46712EB0A51 (score_id), INDEX IDX_E9E9F467E357438D (word_id), PRIMARY KEY(score_id, word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score_user ADD CONSTRAINT FK_A78B573F12EB0A51 FOREIGN KEY (score_id) REFERENCES score (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_user ADD CONSTRAINT FK_A78B573FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_word ADD CONSTRAINT FK_E9E9F46712EB0A51 FOREIGN KEY (score_id) REFERENCES score (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_word ADD CONSTRAINT FK_E9E9F467E357438D FOREIGN KEY (word_id) REFERENCES word (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_user DROP FOREIGN KEY FK_A78B573F12EB0A51');
        $this->addSql('ALTER TABLE score_user DROP FOREIGN KEY FK_A78B573FA76ED395');
        $this->addSql('ALTER TABLE score_word DROP FOREIGN KEY FK_E9E9F46712EB0A51');
        $this->addSql('ALTER TABLE score_word DROP FOREIGN KEY FK_E9E9F467E357438D');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE score_user');
        $this->addSql('DROP TABLE score_word');
    }
}
