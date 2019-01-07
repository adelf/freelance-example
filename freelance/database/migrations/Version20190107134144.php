<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20190107134144 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE clients (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE freelancers (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , email VARCHAR(255) NOT NULL, hourRate_amount INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE jobs (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , client_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8936DC519EB6921 ON jobs (client_id)');
        $this->addSql('CREATE TABLE proposals (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , job_id CHAR(36) DEFAULT NULL --(DC2Type:uuid)
        , freelancer_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , cover_letter VARCHAR(255) NOT NULL, hourRate_amount INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A5BA3A8FBE04EA9 ON proposals (job_id)');
        $this->addSql('CREATE INDEX IDX_A5BA3A8F8545BDF5 ON proposals (freelancer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE freelancers');
        $this->addSql('DROP TABLE jobs');
        $this->addSql('DROP TABLE proposals');
    }
}
