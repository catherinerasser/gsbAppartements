<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323162448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE appartement_id_seq');
        $this->addSql('SELECT setval(\'appartement_id_seq\', (SELECT MAX(id) FROM appartement))');
        $this->addSql('ALTER TABLE appartement ALTER id SET DEFAULT nextval(\'appartement_id_seq\')');
        $this->addSql('CREATE SEQUENCE demandes_id_seq');
        $this->addSql('SELECT setval(\'demandes_id_seq\', (SELECT MAX(id) FROM demandes))');
        $this->addSql('ALTER TABLE demandes ALTER id SET DEFAULT nextval(\'demandes_id_seq\')');
        $this->addSql('CREATE SEQUENCE visite_id_seq');
        $this->addSql('SELECT setval(\'visite_id_seq\', (SELECT MAX(id) FROM visite))');
        $this->addSql('ALTER TABLE visite ALTER id SET DEFAULT nextval(\'visite_id_seq\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE appartement ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE demandes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE visite ALTER id DROP DEFAULT');
    }
}
