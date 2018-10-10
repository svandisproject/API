<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010140916 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE post ADD published_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE post ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE post ALTER COLUMN publishedat DROP NOT NULL');
        $this->addSql('ALTER TABLE post ALTER COLUMN createdat DROP NOT NULL');
        $this->addSql('UPDATE post SET published_at = publishedat;');
        $this->addSql('UPDATE post SET created_at = createdat;');
        $this->addSql('ALTER TABLE post DROP publishedat');
        $this->addSql('ALTER TABLE post DROP createdat');
    }

    public function down(Schema $schema) : void
    {
        return;
    }
}
