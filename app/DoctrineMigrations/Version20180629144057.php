<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180629144057 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('ALTER TABLE asset ADD convertable BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE asset ALTER title DROP NOT NULL');
        $this->addSql('ALTER TABLE asset ALTER price TYPE NUMERIC(25, 15)');
        $this->addSql('ALTER TABLE asset ALTER price DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('ALTER TABLE asset DROP convertable');
        $this->addSql('ALTER TABLE asset ALTER title SET NOT NULL');
        $this->addSql('ALTER TABLE asset ALTER price TYPE INT');
        $this->addSql('ALTER TABLE asset ALTER price DROP DEFAULT');
    }
}
