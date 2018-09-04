<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180904113621 extends AbstractMigration
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
        $this->addSql('ALTER TABLE finance RENAME COLUMN token_price_usd TO token_price_eth');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
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
        $this->addSql('ALTER TABLE finance RENAME COLUMN token_price_eth TO token_price_usd');
    }
}
