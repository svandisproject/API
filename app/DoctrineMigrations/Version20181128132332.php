<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128132332 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE "user" ADD onboarded BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD centralized BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD key_addresses TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD recovery_addresses TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD identity_address VARCHAR(150) DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN "user".key_addresses IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN "user".recovery_addresses IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP onboarded');
        $this->addSql('ALTER TABLE "user" DROP centralized');
        $this->addSql('ALTER TABLE "user" DROP key_addresses');
        $this->addSql('ALTER TABLE "user" DROP recovery_addresses');
        $this->addSql('ALTER TABLE "user" DROP identity_address');
    }
}
