<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616092943 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('TRUNCATE TABLE post CASCADE');
    }

    public function down(Schema $schema) : void
    {
        return;
    }
}
