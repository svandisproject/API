<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181008124459 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE post_liked_by_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_liked_by (id INT NOT NULL, liked_user_id INT DEFAULT NULL, liked_post_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DDF224CADD7690DF ON post_liked_by (liked_user_id)');
        $this->addSql('CREATE INDEX IDX_DDF224CA31914066 ON post_liked_by (liked_post_id)');
        $this->addSql('ALTER TABLE post_liked_by ADD CONSTRAINT FK_DDF224CADD7690DF FOREIGN KEY (liked_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_liked_by ADD CONSTRAINT FK_DDF224CA31914066 FOREIGN KEY (liked_post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_liked_by_id_seq CASCADE');
        $this->addSql('DROP TABLE post_liked_by');
    }
}
