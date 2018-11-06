<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106132342 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE tag_group ADD multiple BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE dev_stages ADD development_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dev_stages ADD CONSTRAINT FK_CB0C219B0B464C4 FOREIGN KEY (development_id) REFERENCES development (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CB0C219B0B464C4 ON dev_stages (development_id)');
        $this->addSql('ALTER TABLE development DROP CONSTRAINT fk_c0d6212a8e55e70a');
        $this->addSql('DROP INDEX idx_c0d6212a8e55e70a');
        $this->addSql('ALTER TABLE development DROP stages_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tag_group DROP multiple');
        $this->addSql('ALTER TABLE dev_stages DROP CONSTRAINT FK_CB0C219B0B464C4');
        $this->addSql('DROP INDEX IDX_CB0C219B0B464C4');
        $this->addSql('ALTER TABLE dev_stages DROP development_id');
        $this->addSql('ALTER TABLE development ADD stages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE development ADD CONSTRAINT fk_c0d6212a8e55e70a FOREIGN KEY (stages_id) REFERENCES dev_stages (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c0d6212a8e55e70a ON development (stages_id)');
    }
}
