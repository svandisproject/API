<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180706133113 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE icos_restrictions DROP CONSTRAINT fk_790a96f7f92f3e70');
        $this->addSql('ALTER TABLE kyc_icos DROP CONSTRAINT fk_82a6498c97a0984b');
        $this->addSql('DROP SEQUENCE kyc_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE volume_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE coin_market_cap_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE volume (id INT NOT NULL, asset_id INT DEFAULT NULL, volume_usd NUMERIC(25, 15) NOT NULL, added_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, exchange VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B99ACDDE5DA1941 ON volume (asset_id)');
        $this->addSql('CREATE TABLE coin_market_cap (id INT NOT NULL, circulating_supply DOUBLE PRECISION NOT NULL, volume24 DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE volume ADD CONSTRAINT FK_B99ACDDE5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE assets_posts');
        $this->addSql('DROP TABLE competitors');
        $this->addSql('DROP TABLE ico_asset');
        $this->addSql('DROP TABLE ico_blockchain_advisors');
        $this->addSql('DROP TABLE ico_industry_advisors');
        $this->addSql('DROP TABLE ico_legal_partners');
        $this->addSql('DROP TABLE ico_member');
        $this->addSql('DROP TABLE icos_industies');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE kyc');
        $this->addSql('DROP TABLE icos_restrictions');
        $this->addSql('DROP TABLE kyc_icos');
        $this->addSql('DROP TABLE price');
        $this->addSql('ALTER TABLE asset ADD ico_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD market_cap_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CBAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C496B9518 FOREIGN KEY (market_cap_id) REFERENCES coin_market_cap (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AF5A5CBAEE09DB ON asset (ico_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AF5A5C496B9518 ON asset (market_cap_id)');
        $this->addSql('ALTER TABLE ico DROP asset');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5C496B9518');
        $this->addSql('DROP SEQUENCE volume_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE coin_market_cap_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE kyc_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE assets_posts (asset_id INT NOT NULL, post_id INT NOT NULL, PRIMARY KEY(asset_id, post_id))');
        $this->addSql('CREATE INDEX idx_e2558a934b89032c ON assets_posts (post_id)');
        $this->addSql('CREATE INDEX idx_e2558a935da1941 ON assets_posts (asset_id)');
        $this->addSql('CREATE TABLE competitors (ico_id INT NOT NULL, competitor_ico_id INT NOT NULL, PRIMARY KEY(ico_id, competitor_ico_id))');
        $this->addSql('CREATE INDEX idx_2ded50c6baee09db ON competitors (ico_id)');
        $this->addSql('CREATE INDEX idx_2ded50c659d12407 ON competitors (competitor_ico_id)');
        $this->addSql('CREATE TABLE ico_asset (ico_id INT NOT NULL, asset_id INT NOT NULL, PRIMARY KEY(ico_id, asset_id))');
        $this->addSql('CREATE INDEX idx_c06af66baee09db ON ico_asset (ico_id)');
        $this->addSql('CREATE INDEX idx_c06af665da1941 ON ico_asset (asset_id)');
        $this->addSql('CREATE TABLE ico_blockchain_advisors (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX idx_545d91ba217bbb47 ON ico_blockchain_advisors (person_id)');
        $this->addSql('CREATE INDEX idx_545d91babaee09db ON ico_blockchain_advisors (ico_id)');
        $this->addSql('CREATE TABLE ico_industry_advisors (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX idx_1a9aa180baee09db ON ico_industry_advisors (ico_id)');
        $this->addSql('CREATE INDEX idx_1a9aa180217bbb47 ON ico_industry_advisors (person_id)');
        $this->addSql('CREATE TABLE ico_legal_partners (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX idx_a18b810a217bbb47 ON ico_legal_partners (person_id)');
        $this->addSql('CREATE INDEX idx_a18b810abaee09db ON ico_legal_partners (ico_id)');
        $this->addSql('CREATE TABLE ico_member (ico_id INT NOT NULL, member_id INT NOT NULL, PRIMARY KEY(ico_id, member_id))');
        $this->addSql('CREATE INDEX idx_b6e68a3f7597d3fe ON ico_member (member_id)');
        $this->addSql('CREATE INDEX idx_b6e68a3fbaee09db ON ico_member (ico_id)');
        $this->addSql('CREATE TABLE icos_industies (ico_id INT NOT NULL, industry_id INT NOT NULL, PRIMARY KEY(ico_id, industry_id))');
        $this->addSql('CREATE INDEX idx_e808369d2b19a734 ON icos_industies (industry_id)');
        $this->addSql('CREATE INDEX idx_e808369dbaee09db ON icos_industies (ico_id)');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE kyc (id INT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE icos_restrictions (ico_id INT NOT NULL, country_id INT NOT NULL, PRIMARY KEY(ico_id, country_id))');
        $this->addSql('CREATE INDEX idx_790a96f7f92f3e70 ON icos_restrictions (country_id)');
        $this->addSql('CREATE INDEX idx_790a96f7baee09db ON icos_restrictions (ico_id)');
        $this->addSql('CREATE TABLE kyc_icos (ico_id INT NOT NULL, kyc_id INT NOT NULL, PRIMARY KEY(ico_id, kyc_id))');
        $this->addSql('CREATE INDEX idx_82a6498c97a0984b ON kyc_icos (kyc_id)');
        $this->addSql('CREATE INDEX idx_82a6498cbaee09db ON kyc_icos (ico_id)');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, currency VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE icos_restrictions ADD CONSTRAINT fk_790a96f7f92f3e70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kyc_icos ADD CONSTRAINT fk_82a6498c97a0984b FOREIGN KEY (kyc_id) REFERENCES kyc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE volume');
        $this->addSql('DROP TABLE coin_market_cap');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5CBAEE09DB');
        $this->addSql('DROP INDEX UNIQ_2AF5A5CBAEE09DB');
        $this->addSql('DROP INDEX UNIQ_2AF5A5C496B9518');
        $this->addSql('ALTER TABLE asset DROP ico_id');
        $this->addSql('ALTER TABLE asset DROP market_cap_id');
        $this->addSql('ALTER TABLE ico ADD asset VARCHAR(255) DEFAULT NULL');
    }
}
