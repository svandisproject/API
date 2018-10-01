<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181001133535 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tag_post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag_post (id INT NOT NULL, user_id INT DEFAULT NULL, tag_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B485D33BA76ED395 ON tag_post (user_id)');
        $this->addSql('CREATE INDEX IDX_B485D33BBAD26311 ON tag_post (tag_id)');
        $this->addSql('CREATE TABLE posts_tags (post_id INT NOT NULL, tag_post_id INT NOT NULL, PRIMARY KEY(post_id, tag_post_id))');
        $this->addSql('CREATE INDEX IDX_D5ECAD9F4B89032C ON posts_tags (post_id)');
        $this->addSql('CREATE INDEX IDX_D5ECAD9F79B82E86 ON posts_tags (tag_post_id)');
        $this->addSql('ALTER TABLE tag_post ADD CONSTRAINT FK_B485D33BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_post ADD CONSTRAINT FK_B485D33BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F79B82E86 FOREIGN KEY (tag_post_id) REFERENCES tag_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE post_tags');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE posts_tags DROP CONSTRAINT FK_D5ECAD9F79B82E86');
        $this->addSql('DROP SEQUENCE tag_post_id_seq CASCADE');
        $this->addSql('CREATE TABLE post_tags (post_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('CREATE INDEX idx_a6e9f32dbad26311 ON post_tags (tag_id)');
        $this->addSql('CREATE INDEX idx_a6e9f32d4b89032c ON post_tags (post_id)');
        $this->addSql('ALTER TABLE post_tags ADD CONSTRAINT fk_a6e9f32d4b89032c FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_tags ADD CONSTRAINT fk_a6e9f32dbad26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE tag_post');
        $this->addSql('DROP TABLE posts_tags');
    }
}
