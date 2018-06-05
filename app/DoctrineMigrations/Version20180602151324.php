<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180602151324 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ico_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE kyc_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE industry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE token_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE person (id INT NOT NULL, name VARCHAR(100) NOT NULL, title VARCHAR(255) DEFAULT NULL, subdivision VARCHAR(255) DEFAULT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ico (id INT NOT NULL, token_type_id INT DEFAULT NULL, rating NUMERIC(10, 0) NOT NULL, rating_team NUMERIC(10, 0) DEFAULT NULL, rating_profile NUMERIC(10, 0) DEFAULT NULL, rating_vision NUMERIC(10, 0) DEFAULT NULL, rating_product NUMERIC(10, 0) DEFAULT NULL, remote_id INT NOT NULL, ico_url VARCHAR(255) DEFAULT NULL, ico_tagline VARCHAR(255) DEFAULT NULL, ico_intro TEXT DEFAULT NULL, ico_about TEXT DEFAULT NULL, restricted_countries TEXT DEFAULT NULL, ico_token VARCHAR(100) NOT NULL, ico_platform VARCHAR(100) NOT NULL, ico_token_price VARCHAR(255) DEFAULT NULL, hard_cap VARCHAR(255) DEFAULT NULL, min_cap VARCHAR(255) DEFAULT NULL, raised VARCHAR(255) NOT NULL, bonus BOOLEAN DEFAULT NULL, open_presale TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, team_tokens INT DEFAULT NULL, smart_contract_audit BOOLEAN DEFAULT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D102A3E9C94 ON ico (remote_id)');
        $this->addSql('CREATE INDEX IDX_2B9A6D102B439510 ON ico (token_type_id)');
        $this->addSql('COMMENT ON COLUMN ico.restricted_countries IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE ico_asset (ico_id INT NOT NULL, asset_id INT NOT NULL, PRIMARY KEY(ico_id, asset_id))');
        $this->addSql('CREATE INDEX IDX_C06AF66BAEE09DB ON ico_asset (ico_id)');
        $this->addSql('CREATE INDEX IDX_C06AF665DA1941 ON ico_asset (asset_id)');
        $this->addSql('CREATE TABLE ico_blockchain_advisors (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX IDX_545D91BABAEE09DB ON ico_blockchain_advisors (ico_id)');
        $this->addSql('CREATE INDEX IDX_545D91BA217BBB47 ON ico_blockchain_advisors (person_id)');
        $this->addSql('CREATE TABLE ico_industry_advisors (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX IDX_1A9AA180BAEE09DB ON ico_industry_advisors (ico_id)');
        $this->addSql('CREATE INDEX IDX_1A9AA180217BBB47 ON ico_industry_advisors (person_id)');
        $this->addSql('CREATE TABLE ico_legal_partners (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX IDX_A18B810ABAEE09DB ON ico_legal_partners (ico_id)');
        $this->addSql('CREATE INDEX IDX_A18B810A217BBB47 ON ico_legal_partners (person_id)');
        $this->addSql('CREATE TABLE icos_industies (ico_id INT NOT NULL, industry_id INT NOT NULL, PRIMARY KEY(ico_id, industry_id))');
        $this->addSql('CREATE INDEX IDX_E808369DBAEE09DB ON icos_industies (ico_id)');
        $this->addSql('CREATE INDEX IDX_E808369D2B19A734 ON icos_industies (industry_id)');
        $this->addSql('CREATE TABLE competitors (ico_id INT NOT NULL, competitor_ico_id INT NOT NULL, PRIMARY KEY(ico_id, competitor_ico_id))');
        $this->addSql('CREATE INDEX IDX_2DED50C6BAEE09DB ON competitors (ico_id)');
        $this->addSql('CREATE INDEX IDX_2DED50C659D12407 ON competitors (competitor_ico_id)');
        $this->addSql('CREATE TABLE kyc_icos (ico_id INT NOT NULL, kyc_id INT NOT NULL, PRIMARY KEY(ico_id, kyc_id))');
        $this->addSql('CREATE INDEX IDX_82A6498CBAEE09DB ON kyc_icos (ico_id)');
        $this->addSql('CREATE INDEX IDX_82A6498C97A0984B ON kyc_icos (kyc_id)');
        $this->addSql('CREATE TABLE ico_member (ico_id INT NOT NULL, member_id INT NOT NULL, PRIMARY KEY(ico_id, member_id))');
        $this->addSql('CREATE INDEX IDX_B6E68A3FBAEE09DB ON ico_member (ico_id)');
        $this->addSql('CREATE INDEX IDX_B6E68A3F7597D3FE ON ico_member (member_id)');
        $this->addSql('CREATE TABLE kyc (id INT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE industry (id INT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE token_type (id INT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D102B439510 FOREIGN KEY (token_type_id) REFERENCES token_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_asset ADD CONSTRAINT FK_C06AF66BAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_asset ADD CONSTRAINT FK_C06AF665DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_blockchain_advisors ADD CONSTRAINT FK_545D91BABAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_blockchain_advisors ADD CONSTRAINT FK_545D91BA217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_industry_advisors ADD CONSTRAINT FK_1A9AA180BAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_industry_advisors ADD CONSTRAINT FK_1A9AA180217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_legal_partners ADD CONSTRAINT FK_A18B810ABAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_legal_partners ADD CONSTRAINT FK_A18B810A217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE icos_industies ADD CONSTRAINT FK_E808369DBAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE icos_industies ADD CONSTRAINT FK_E808369D2B19A734 FOREIGN KEY (industry_id) REFERENCES industry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE competitors ADD CONSTRAINT FK_2DED50C6BAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE competitors ADD CONSTRAINT FK_2DED50C659D12407 FOREIGN KEY (competitor_ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kyc_icos ADD CONSTRAINT FK_82A6498CBAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kyc_icos ADD CONSTRAINT FK_82A6498C97A0984B FOREIGN KEY (kyc_id) REFERENCES kyc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_member ADD CONSTRAINT FK_B6E68A3FBAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_member ADD CONSTRAINT FK_B6E68A3F7597D3FE FOREIGN KEY (member_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE ico_blockchain_advisors DROP CONSTRAINT FK_545D91BA217BBB47');
        $this->addSql('ALTER TABLE ico_industry_advisors DROP CONSTRAINT FK_1A9AA180217BBB47');
        $this->addSql('ALTER TABLE ico_legal_partners DROP CONSTRAINT FK_A18B810A217BBB47');
        $this->addSql('ALTER TABLE ico_member DROP CONSTRAINT FK_B6E68A3F7597D3FE');
        $this->addSql('ALTER TABLE ico_asset DROP CONSTRAINT FK_C06AF66BAEE09DB');
        $this->addSql('ALTER TABLE ico_blockchain_advisors DROP CONSTRAINT FK_545D91BABAEE09DB');
        $this->addSql('ALTER TABLE ico_industry_advisors DROP CONSTRAINT FK_1A9AA180BAEE09DB');
        $this->addSql('ALTER TABLE ico_legal_partners DROP CONSTRAINT FK_A18B810ABAEE09DB');
        $this->addSql('ALTER TABLE icos_industies DROP CONSTRAINT FK_E808369DBAEE09DB');
        $this->addSql('ALTER TABLE competitors DROP CONSTRAINT FK_2DED50C6BAEE09DB');
        $this->addSql('ALTER TABLE competitors DROP CONSTRAINT FK_2DED50C659D12407');
        $this->addSql('ALTER TABLE kyc_icos DROP CONSTRAINT FK_82A6498CBAEE09DB');
        $this->addSql('ALTER TABLE ico_member DROP CONSTRAINT FK_B6E68A3FBAEE09DB');
        $this->addSql('ALTER TABLE kyc_icos DROP CONSTRAINT FK_82A6498C97A0984B');
        $this->addSql('ALTER TABLE icos_industies DROP CONSTRAINT FK_E808369D2B19A734');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D102B439510');
        $this->addSql('DROP SEQUENCE person_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ico_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE kyc_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE industry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE token_type_id_seq CASCADE');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE ico');
        $this->addSql('DROP TABLE ico_asset');
        $this->addSql('DROP TABLE ico_blockchain_advisors');
        $this->addSql('DROP TABLE ico_industry_advisors');
        $this->addSql('DROP TABLE ico_legal_partners');
        $this->addSql('DROP TABLE icos_industies');
        $this->addSql('DROP TABLE competitors');
        $this->addSql('DROP TABLE kyc_icos');
        $this->addSql('DROP TABLE ico_member');
        $this->addSql('DROP TABLE kyc');
        $this->addSql('DROP TABLE industry');
        $this->addSql('DROP TABLE token_type');
    }
}
