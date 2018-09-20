<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180920101754 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE tradable_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tradable_token (id INT NOT NULL, change NUMERIC(25, 15) DEFAULT NULL, weekly_change NUMERIC(25, 15) DEFAULT NULL, year_to_day_change NUMERIC(25, 15) DEFAULT NULL, ticker VARCHAR(25) NOT NULL, title VARCHAR(255) DEFAULT NULL, algorithm VARCHAR(25) DEFAULT NULL, type VARCHAR(25) DEFAULT NULL, age INT DEFAULT NULL, sector VARCHAR(25) DEFAULT NULL, ico_amount INT DEFAULT NULL, return_on_ico NUMERIC(25, 15) DEFAULT NULL, market_cap NUMERIC(25, 15) DEFAULT NULL, price NUMERIC(25, 15) DEFAULT NULL, last_price NUMERIC(25, 15) DEFAULT NULL, initial_price NUMERIC(25, 15) DEFAULT NULL, price_change_percent NUMERIC(25, 15) DEFAULT NULL, price_change_hour NUMERIC(25, 15) DEFAULT NULL, price_change_day NUMERIC(25, 15) DEFAULT NULL, price_change_month NUMERIC(25, 15) DEFAULT NULL, price_change_six_month NUMERIC(25, 15) DEFAULT NULL, circulating_supply BIGINT DEFAULT NULL, max_supply BIGINT DEFAULT NULL, volume NUMERIC(25, 15) DEFAULT NULL, volume_day NUMERIC(25, 15) DEFAULT NULL, avg_volume_weeks52 NUMERIC(25, 15) DEFAULT NULL, twitter TEXT DEFAULT NULL, telegramm TEXT DEFAULT NULL, reddit TEXT DEFAULT NULL, facebook TEXT DEFAULT NULL, medium TEXT DEFAULT NULL, steemit TEXT DEFAULT NULL, discord TEXT DEFAULT NULL, medium_followers INT DEFAULT NULL, telegramm_followers INT DEFAULT NULL, twitter_followers INT DEFAULT NULL, reddit_subscriber INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE asset ADD tradable_token_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C1B3A9CB2 FOREIGN KEY (tradable_token_id) REFERENCES tradable_token (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AF5A5C1B3A9CB2 ON asset (tradable_token_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE asset DROP CONSTRAINT FK_2AF5A5C1B3A9CB2');
        $this->addSql('DROP SEQUENCE tradable_token_id_seq CASCADE');
        $this->addSql('DROP TABLE tradable_token');
        $this->addSql('DROP INDEX UNIQ_2AF5A5C1B3A9CB2');
        $this->addSql('ALTER TABLE asset DROP tradable_token_id');
    }
}
