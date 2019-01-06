<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20190106181927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE jobs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A8936DC519EB6921 ON jobs (client_id)');
        $this->addSql('CREATE TABLE proposals (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, job_id INTEGER DEFAULT NULL, freelancer_id INTEGER NOT NULL, cover_letter VARCHAR(255) NOT NULL, hourRate_amount INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A5BA3A8FBE04EA9 ON proposals (job_id)');
        $this->addSql('CREATE INDEX IDX_A5BA3A8F8545BDF5 ON proposals (freelancer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE jobs');
        $this->addSql('DROP TABLE proposals');
    }
}
