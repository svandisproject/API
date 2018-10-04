<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181001143357 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE algorithm_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE algorithm (id INT NOT NULL, title VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9505CCB92B36786B ON algorithm (title)');
        $this->addSql('ALTER TABLE coin_market_cap ADD volume_year DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE coin_market_cap ADD max_supply DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD algorithm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD minable BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD rank INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD official_links TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN asset.official_links IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CBBEB6CF7 FOREIGN KEY (algorithm_id) REFERENCES algorithm (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2AF5A5CBBEB6CF7 ON asset (algorithm_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5CBBEB6CF7');
        $this->addSql('DROP SEQUENCE algorithm_id_seq CASCADE');
        $this->addSql('DROP TABLE algorithm');
        $this->addSql('ALTER TABLE coin_market_cap DROP volume_year');
        $this->addSql('ALTER TABLE coin_market_cap DROP max_supply');
        $this->addSql('DROP INDEX IDX_2AF5A5CBBEB6CF7');
        $this->addSql('ALTER TABLE asset DROP algorithm_id');
        $this->addSql('ALTER TABLE asset DROP minable');
        $this->addSql('ALTER TABLE asset DROP rank');
        $this->addSql('ALTER TABLE asset DROP age');
        $this->addSql('ALTER TABLE asset DROP official_links');
    }
}
