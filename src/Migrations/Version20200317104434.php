<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317104434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE personne ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE admin DROP num_cpte_banque');
        $this->addSql('ALTER TABLE admin DROP nom_pe');
        $this->addSql('ALTER TABLE admin DROP prenom_pe');
        $this->addSql('ALTER TABLE admin DROP adresse_pe');
        $this->addSql('ALTER TABLE admin DROP telephone_pe');
        $this->addSql('ALTER TABLE admin DROP code_postal');
        $this->addSql('ALTER TABLE admin DROP nom_ville');
        $this->addSql('ALTER TABLE admin DROP email');
        $this->addSql('ALTER TABLE admin DROP login');
        $this->addSql('ALTER TABLE admin DROP mdp');
        $this->addSql('ALTER TABLE admin DROP anniv');
        $this->addSql('ALTER TABLE admin DROP tel_banque');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proprietaire DROP num_cpte_banque');
        $this->addSql('ALTER TABLE proprietaire DROP nom_pe');
        $this->addSql('ALTER TABLE proprietaire DROP prenom_pe');
        $this->addSql('ALTER TABLE proprietaire DROP adresse_pe');
        $this->addSql('ALTER TABLE proprietaire DROP telephone_pe');
        $this->addSql('ALTER TABLE proprietaire DROP code_postal');
        $this->addSql('ALTER TABLE proprietaire DROP nom_ville');
        $this->addSql('ALTER TABLE proprietaire DROP email');
        $this->addSql('ALTER TABLE proprietaire DROP login');
        $this->addSql('ALTER TABLE proprietaire DROP mdp');
        $this->addSql('ALTER TABLE proprietaire DROP anniv');
        $this->addSql('ALTER TABLE proprietaire DROP tel_banque');
        $this->addSql('ALTER TABLE proprietaire ADD CONSTRAINT FK_69E399D6BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE locataire DROP num_cpte_banque');
        $this->addSql('ALTER TABLE locataire DROP nom_pe');
        $this->addSql('ALTER TABLE locataire DROP prenom_pe');
        $this->addSql('ALTER TABLE locataire DROP adresse_pe');
        $this->addSql('ALTER TABLE locataire DROP telephone_pe');
        $this->addSql('ALTER TABLE locataire DROP code_postal');
        $this->addSql('ALTER TABLE locataire DROP nom_ville');
        $this->addSql('ALTER TABLE locataire DROP email');
        $this->addSql('ALTER TABLE locataire DROP login');
        $this->addSql('ALTER TABLE locataire DROP mdp');
        $this->addSql('ALTER TABLE locataire DROP anniv');
        $this->addSql('ALTER TABLE locataire DROP tel_banque');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EBBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client DROP num_cpte_banque');
        $this->addSql('ALTER TABLE client DROP nom_pe');
        $this->addSql('ALTER TABLE client DROP prenom_pe');
        $this->addSql('ALTER TABLE client DROP adresse_pe');
        $this->addSql('ALTER TABLE client DROP telephone_pe');
        $this->addSql('ALTER TABLE client DROP code_postal');
        $this->addSql('ALTER TABLE client DROP nom_ville');
        $this->addSql('ALTER TABLE client DROP email');
        $this->addSql('ALTER TABLE client DROP login');
        $this->addSql('ALTER TABLE client DROP mdp');
        $this->addSql('ALTER TABLE client DROP anniv');
        $this->addSql('ALTER TABLE client DROP tel_banque');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE personne DROP type');
        $this->addSql('ALTER TABLE locataire DROP CONSTRAINT FK_C47CF6EBBF396750');
        $this->addSql('ALTER TABLE locataire ADD num_cpte_banque VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE locataire ADD nom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD prenom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD adresse_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD telephone_pe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD code_postal INT DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD nom_ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD login VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE locataire ADD mdp VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE locataire ADD anniv DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire ADD tel_banque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin DROP CONSTRAINT FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE admin ADD num_cpte_banque VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE admin ADD nom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD prenom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD adresse_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD telephone_pe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD code_postal INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD nom_ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD login VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE admin ADD mdp VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE admin ADD anniv DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD tel_banque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire DROP CONSTRAINT FK_69E399D6BF396750');
        $this->addSql('ALTER TABLE proprietaire ADD num_cpte_banque VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD nom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD prenom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD adresse_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD telephone_pe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD code_postal INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD nom_ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD login VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD mdp VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD anniv DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE proprietaire ADD tel_banque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455BF396750');
        $this->addSql('ALTER TABLE client ADD num_cpte_banque VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client ADD nom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD prenom_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD adresse_pe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD telephone_pe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD code_postal INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD nom_ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD login VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client ADD mdp VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client ADD anniv DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD tel_banque INT DEFAULT NULL');
    }
}
