<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123165544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_user DROP FOREIGN KEY FK_A78B573F12EB0A51');
        $this->addSql('ALTER TABLE score_user DROP FOREIGN KEY FK_A78B573FA76ED395');
        $this->addSql('ALTER TABLE score_word DROP FOREIGN KEY FK_E9E9F46712EB0A51');
        $this->addSql('ALTER TABLE score_word DROP FOREIGN KEY FK_E9E9F467E357438D');
        $this->addSql('DROP TABLE score_user');
        $this->addSql('DROP TABLE score_word');
        $this->addSql('ALTER TABLE score ADD id_word_id INT NOT NULL, ADD attempt_count INT NOT NULL, CHANGE score id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_3299375179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937513DCAEAFD FOREIGN KEY (id_word_id) REFERENCES word (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3299375179F37AE5 ON score (id_user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_329937513DCAEAFD ON score (id_word_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score_user (score_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A78B573F12EB0A51 (score_id), INDEX IDX_A78B573FA76ED395 (user_id), PRIMARY KEY(score_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE score_word (score_id INT NOT NULL, word_id INT NOT NULL, INDEX IDX_E9E9F46712EB0A51 (score_id), INDEX IDX_E9E9F467E357438D (word_id), PRIMARY KEY(score_id, word_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE score_user ADD CONSTRAINT FK_A78B573F12EB0A51 FOREIGN KEY (score_id) REFERENCES score (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_user ADD CONSTRAINT FK_A78B573FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_word ADD CONSTRAINT FK_E9E9F46712EB0A51 FOREIGN KEY (score_id) REFERENCES score (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score_word ADD CONSTRAINT FK_E9E9F467E357438D FOREIGN KEY (word_id) REFERENCES word (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_3299375179F37AE5');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937513DCAEAFD');
        $this->addSql('DROP INDEX UNIQ_3299375179F37AE5 ON score');
        $this->addSql('DROP INDEX UNIQ_329937513DCAEAFD ON score');
        $this->addSql('ALTER TABLE score ADD score INT NOT NULL, DROP id_user_id, DROP id_word_id, DROP attempt_count');
    }
}
