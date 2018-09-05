<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905113443 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE refresh_tokens_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE "user_id_seq" INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tag_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE post_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE worker_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE reddit_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE facebook_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE web_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE twitter_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE coin_market_cap_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE asset_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE token_type_standard_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE token_type_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE volume_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE mood_signal_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE legal_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE finance_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE dev_stages_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE department_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE development_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE consensus_type_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE person_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE industry_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE ico_values_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE ico_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE social_media_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE sale_stage_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE dates_id_seq INCREMENT BY 1');
        $this->addSql('DROP TABLE ico_advisors');
        $this->addSql('ALTER TABLE post ADD ico_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBAEE09DB FOREIGN KEY (ico_id) REFERENCES ico (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DBAEE09DB ON post (ico_id)');
        $this->addSql('ALTER TABLE asset ADD token_type_standard_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ALTER ticker TYPE VARCHAR(25)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CC2A83742 FOREIGN KEY (token_type_standard_id) REFERENCES token_type_standard (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2AF5A5CC2A83742 ON asset (token_type_standard_id)');
        $this->addSql('ALTER TABLE finances_persons ADD CONSTRAINT FK_6387A204217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE person ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD nationality VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD kyc BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD relevant_experience TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD advisor BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE person ALTER links TYPE TEXT');
        $this->addSql('ALTER TABLE person ALTER links DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN person.relevant_experience IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_34DCD176AE80F5DF ON person (department_id)');
        $this->addSql('DROP INDEX uniq_2b9a6d102a3e9c94');
        $this->addSql('ALTER TABLE ico ADD finance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD sale_stage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD values_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD social_media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD development_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD legal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD slogan TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD problem TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD staff_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD links TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico DROP open_presale');
        $this->addSql('ALTER TABLE ico DROP kyc');
        $this->addSql('ALTER TABLE ico DROP hard_cap');
        $this->addSql('ALTER TABLE ico DROP raised');
        $this->addSql('ALTER TABLE ico DROP token_price');
        $this->addSql('ALTER TABLE ico DROP token_sale_date');
        $this->addSql('ALTER TABLE ico ALTER remote_id DROP NOT NULL');
        $this->addSql('ALTER TABLE ico ALTER restricted_countries DROP NOT NULL');
        $this->addSql('ALTER TABLE ico RENAME COLUMN total_cap TO dates_id');
        $this->addSql('COMMENT ON COLUMN ico.links IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D103DA992C3 FOREIGN KEY (dates_id) REFERENCES dates (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D105E87A6C2 FOREIGN KEY (finance_id) REFERENCES finance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D103CEC3D39 FOREIGN KEY (sale_stage_id) REFERENCES sale_stage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D10DF505F5A FOREIGN KEY (values_id) REFERENCES ico_values (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D1064AE4959 FOREIGN KEY (social_media_id) REFERENCES social_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D10B0B464C4 FOREIGN KEY (development_id) REFERENCES development (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico ADD CONSTRAINT FK_2B9A6D1062BB3C59 FOREIGN KEY (legal_id) REFERENCES legal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D103DA992C3 ON ico (dates_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D105E87A6C2 ON ico (finance_id)');
        $this->addSql('CREATE INDEX IDX_2B9A6D103CEC3D39 ON ico (sale_stage_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D10DF505F5A ON ico (values_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D1064AE4959 ON ico (social_media_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D10B0B464C4 ON ico (development_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2B9A6D1062BB3C59 ON ico (legal_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER SEQUENCE department_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE development_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE consensus_type_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE ico_values_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE social_media_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE sale_stage_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE dates_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE token_type_standard_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE mood_signal_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE legal_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE finance_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE dev_stages_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE refresh_tokens_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE user_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE tag_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE post_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE worker_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE reddit_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE facebook_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE web_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE twitter_feed_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE coin_market_cap_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE asset_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE token_type_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE volume_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE person_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE industry_id_seq INCREMENT BY 1');
        $this->addSql('ALTER SEQUENCE ico_id_seq INCREMENT BY 1');
        $this->addSql('CREATE TABLE ico_advisors (ico_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(ico_id, person_id))');
        $this->addSql('CREATE INDEX idx_4efa3a3bbaee09db ON ico_advisors (ico_id)');
        $this->addSql('CREATE INDEX idx_4efa3a3b217bbb47 ON ico_advisors (person_id)');
        $this->addSql('ALTER TABLE ico_advisors ADD CONSTRAINT fk_4efa3a3bbaee09db FOREIGN KEY (ico_id) REFERENCES ico (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ico_advisors ADD CONSTRAINT fk_4efa3a3b217bbb47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE finances_persons DROP CONSTRAINT FK_6387A204217BBB47');
        $this->addSql('ALTER TABLE person DROP CONSTRAINT FK_34DCD176AE80F5DF');
        $this->addSql('DROP INDEX IDX_34DCD176AE80F5DF');
        $this->addSql('ALTER TABLE person DROP department_id');
        $this->addSql('ALTER TABLE person DROP title');
        $this->addSql('ALTER TABLE person DROP photo');
        $this->addSql('ALTER TABLE person DROP nationality');
        $this->addSql('ALTER TABLE person DROP kyc');
        $this->addSql('ALTER TABLE person DROP relevant_experience');
        $this->addSql('ALTER TABLE person DROP advisor');
        $this->addSql('ALTER TABLE person ALTER links TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE person ALTER links DROP DEFAULT');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D103DA992C3');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D105E87A6C2');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D103CEC3D39');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D10DF505F5A');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D1064AE4959');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D10B0B464C4');
        $this->addSql('ALTER TABLE ico DROP CONSTRAINT FK_2B9A6D1062BB3C59');
        $this->addSql('DROP INDEX UNIQ_2B9A6D103DA992C3');
        $this->addSql('DROP INDEX UNIQ_2B9A6D105E87A6C2');
        $this->addSql('DROP INDEX IDX_2B9A6D103CEC3D39');
        $this->addSql('DROP INDEX UNIQ_2B9A6D10DF505F5A');
        $this->addSql('DROP INDEX UNIQ_2B9A6D1064AE4959');
        $this->addSql('DROP INDEX UNIQ_2B9A6D10B0B464C4');
        $this->addSql('DROP INDEX UNIQ_2B9A6D1062BB3C59');
        $this->addSql('ALTER TABLE ico ADD open_presale TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD kyc BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD hard_cap VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD total_cap INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD raised NUMERIC(10, 0) DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD token_price NUMERIC(25, 15) DEFAULT NULL');
        $this->addSql('ALTER TABLE ico ADD token_sale_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE ico DROP dates_id');
        $this->addSql('ALTER TABLE ico DROP finance_id');
        $this->addSql('ALTER TABLE ico DROP sale_stage_id');
        $this->addSql('ALTER TABLE ico DROP values_id');
        $this->addSql('ALTER TABLE ico DROP social_media_id');
        $this->addSql('ALTER TABLE ico DROP development_id');
        $this->addSql('ALTER TABLE ico DROP legal_id');
        $this->addSql('ALTER TABLE ico DROP description');
        $this->addSql('ALTER TABLE ico DROP slogan');
        $this->addSql('ALTER TABLE ico DROP problem');
        $this->addSql('ALTER TABLE ico DROP staff_size');
        $this->addSql('ALTER TABLE ico DROP links');
        $this->addSql('ALTER TABLE ico ALTER remote_id SET NOT NULL');
        $this->addSql('ALTER TABLE ico ALTER restricted_countries SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_2b9a6d102a3e9c94 ON ico (remote_id)');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DBAEE09DB');
        $this->addSql('DROP INDEX IDX_5A8A6C8DBAEE09DB');
        $this->addSql('ALTER TABLE post DROP ico_id');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5CC2A83742');
        $this->addSql('DROP INDEX IDX_2AF5A5CC2A83742');
        $this->addSql('ALTER TABLE asset DROP token_type_standard_id');
        $this->addSql('ALTER TABLE asset ALTER ticker TYPE VARCHAR(10)');
    }
}
