<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107075137 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE dev_stages ADD development_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dev_stages ADD CONSTRAINT FK_CB0C219B0B464C4 FOREIGN KEY (development_id) REFERENCES development (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CB0C219B0B464C4 ON dev_stages (development_id)');
        $this->addSql('ALTER TABLE development DROP CONSTRAINT fk_c0d6212a8e55e70a');
        $this->addSql('DROP INDEX idx_c0d6212a8e55e70a');
        $this->addSql('ALTER TABLE development DROP stages_id');
        $this->addSql('ALTER TABLE ico_values ALTER white_list DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER staking DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER masternodes DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER dividend DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER burning DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER vesting DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER vcs DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER accredited_investors DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER demoavailability DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER smartcontractaudit DROP NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER open_presale DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dev_stages DROP CONSTRAINT FK_CB0C219B0B464C4');
        $this->addSql('DROP INDEX IDX_CB0C219B0B464C4');
        $this->addSql('ALTER TABLE dev_stages DROP development_id');
        $this->addSql('ALTER TABLE development ADD stages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE development ADD CONSTRAINT fk_c0d6212a8e55e70a FOREIGN KEY (stages_id) REFERENCES dev_stages (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c0d6212a8e55e70a ON development (stages_id)');
        $this->addSql('ALTER TABLE ico_values ALTER white_list SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER staking SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER masternodes SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER dividend SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER burning SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER vesting SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER vcs SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER accredited_investors SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER demoAvailability SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER smartContractAudit SET NOT NULL');
        $this->addSql('ALTER TABLE ico_values ALTER open_presale SET NOT NULL');
    }
}
