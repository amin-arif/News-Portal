<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504081124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD contact_number VARCHAR(255) NOT NULL, ADD dob DATE DEFAULT NULL, ADD gender VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD salary DOUBLE PRECISION NOT NULL, ADD disjointed_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP contact_number, DROP dob, DROP gender, DROP address, DROP salary, DROP disjointed_date');
    }
}
