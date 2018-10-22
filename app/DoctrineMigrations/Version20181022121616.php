<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181022121616 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tag_added_by_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag_added_by (id INT NOT NULL, post_id INT DEFAULT NULL, user_id INT DEFAULT NULL, tag_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5FAA10744B89032C ON tag_added_by (post_id)');
        $this->addSql('CREATE INDEX IDX_5FAA1074A76ED395 ON tag_added_by (user_id)');
        $this->addSql('CREATE INDEX IDX_5FAA1074BAD26311 ON tag_added_by (tag_id)');
        $this->addSql('ALTER TABLE tag_added_by ADD CONSTRAINT FK_5FAA10744B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_added_by ADD CONSTRAINT FK_5FAA1074A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_added_by ADD CONSTRAINT FK_5FAA1074BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE web_feed RENAME COLUMN title_selector TO link_selector');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tag_added_by_id_seq CASCADE');
        $this->addSql('DROP TABLE tag_added_by');
        $this->addSql('ALTER TABLE web_feed RENAME COLUMN link_selector TO title_selector');
    }
}
