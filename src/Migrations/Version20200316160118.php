<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316160118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE test1 DROP CONSTRAINT id_test2');
        $this->addSql('CREATE SEQUENCE personne_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE appartement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE photo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE arrondissement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE demandes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE banque_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE visite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE personne (id INT NOT NULL, num_cpte_banque VARCHAR(255) NOT NULL, nom_pe VARCHAR(255) DEFAULT NULL, prenom_pe VARCHAR(255) DEFAULT NULL, adresse_pe VARCHAR(255) DEFAULT NULL, telephone_pe INT DEFAULT NULL, code_postal INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, anniv DATE DEFAULT NULL, tel_banque INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, num_cpte_banque VARCHAR(255) NOT NULL, nom_pe VARCHAR(255) DEFAULT NULL, prenom_pe VARCHAR(255) DEFAULT NULL, adresse_pe VARCHAR(255) DEFAULT NULL, telephone_pe INT DEFAULT NULL, code_postal INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, anniv DATE DEFAULT NULL, tel_banque INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE admin_appartement (admin_id INT NOT NULL, appartement_id INT NOT NULL, PRIMARY KEY(admin_id, appartement_id))');
        $this->addSql('CREATE INDEX IDX_ECBCF484642B8210 ON admin_appartement (admin_id)');
        $this->addSql('CREATE INDEX IDX_ECBCF484E1729BBA ON admin_appartement (appartement_id)');
        $this->addSql('CREATE TABLE appartement (id INT NOT NULL, id_pro_id INT NOT NULL, nom_appart VARCHAR(255) NOT NULL, nb_voy INT NOT NULL, nb_chamb INT NOT NULL, nb_lits INT NOT NULL, nb_sb INT NOT NULL, wifi BOOLEAN NOT NULL, chauffage BOOLEAN NOT NULL, cuisine BOOLEAN NOT NULL, lave_linge BOOLEAN NOT NULL, type_appart VARCHAR(255) NOT NULL, prix_loc INT NOT NULL, prix_charges INT NOT NULL, rue VARCHAR(255) NOT NULL, arrondissement INT NOT NULL, etage INT NOT NULL, ascenseur BOOLEAN NOT NULL, preavis BOOLEAN NOT NULL, date_libre DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_71A6BD8DE5805157 ON appartement (id_pro_id)');
        $this->addSql('CREATE TABLE proprietaire (id INT NOT NULL, num_cpte_banque VARCHAR(255) NOT NULL, nom_pe VARCHAR(255) DEFAULT NULL, prenom_pe VARCHAR(255) DEFAULT NULL, adresse_pe VARCHAR(255) DEFAULT NULL, telephone_pe INT DEFAULT NULL, code_postal INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, anniv DATE DEFAULT NULL, tel_banque INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE photo (id INT NOT NULL, id_appartement_id INT DEFAULT NULL, nom_photo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_14B78418DC1426BC ON photo (id_appartement_id)');
        $this->addSql('CREATE TABLE locataire (id INT NOT NULL, id_banque_id INT DEFAULT NULL, num_cpte_banque VARCHAR(255) NOT NULL, nom_pe VARCHAR(255) DEFAULT NULL, prenom_pe VARCHAR(255) DEFAULT NULL, adresse_pe VARCHAR(255) DEFAULT NULL, telephone_pe INT DEFAULT NULL, code_postal INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, anniv DATE DEFAULT NULL, tel_banque INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C47CF6EBB7D53CFE ON locataire (id_banque_id)');
        $this->addSql('CREATE TABLE arrondissement (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE arrondissement_demandes (arrondissement_id INT NOT NULL, demandes_id INT NOT NULL, PRIMARY KEY(arrondissement_id, demandes_id))');
        $this->addSql('CREATE INDEX IDX_2D5B60BD407DBC11 ON arrondissement_demandes (arrondissement_id)');
        $this->addSql('CREATE INDEX IDX_2D5B60BDF49DCC2D ON arrondissement_demandes (demandes_id)');
        $this->addSql('CREATE TABLE demandes (id INT NOT NULL, id_client_id INT NOT NULL, type_demande VARCHAR(255) NOT NULL, date_arrive DATE NOT NULL, date_depart DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BD940CBB99DED506 ON demandes (id_client_id)');
        $this->addSql('CREATE TABLE banque (id INT NOT NULL, rue_banque VARCHAR(255) NOT NULL, code_postal_banque INT NOT NULL, ville_banque VARCHAR(255) NOT NULL, tel_banque INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE visite (id INT NOT NULL, id_client_id INT DEFAULT NULL, id_appartement_id INT DEFAULT NULL, date_visite DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B09C8CBB99DED506 ON visite (id_client_id)');
        $this->addSql('CREATE INDEX IDX_B09C8CBBDC1426BC ON visite (id_appartement_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, num_cpte_banque VARCHAR(255) NOT NULL, nom_pe VARCHAR(255) DEFAULT NULL, prenom_pe VARCHAR(255) DEFAULT NULL, adresse_pe VARCHAR(255) DEFAULT NULL, telephone_pe INT DEFAULT NULL, code_postal INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, anniv DATE DEFAULT NULL, tel_banque INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE admin_appartement ADD CONSTRAINT FK_ECBCF484642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE admin_appartement ADD CONSTRAINT FK_ECBCF484E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8DE5805157 FOREIGN KEY (id_pro_id) REFERENCES proprietaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418DC1426BC FOREIGN KEY (id_appartement_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE locataire ADD CONSTRAINT FK_C47CF6EBB7D53CFE FOREIGN KEY (id_banque_id) REFERENCES banque (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE arrondissement_demandes ADD CONSTRAINT FK_2D5B60BD407DBC11 FOREIGN KEY (arrondissement_id) REFERENCES arrondissement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE arrondissement_demandes ADD CONSTRAINT FK_2D5B60BDF49DCC2D FOREIGN KEY (demandes_id) REFERENCES demandes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBDC1426BC FOREIGN KEY (id_appartement_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE test2');
        $this->addSql('DROP TABLE test1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE admin_appartement DROP CONSTRAINT FK_ECBCF484642B8210');
        $this->addSql('ALTER TABLE admin_appartement DROP CONSTRAINT FK_ECBCF484E1729BBA');
        $this->addSql('ALTER TABLE photo DROP CONSTRAINT FK_14B78418DC1426BC');
        $this->addSql('ALTER TABLE visite DROP CONSTRAINT FK_B09C8CBBDC1426BC');
        $this->addSql('ALTER TABLE appartement DROP CONSTRAINT FK_71A6BD8DE5805157');
        $this->addSql('ALTER TABLE arrondissement_demandes DROP CONSTRAINT FK_2D5B60BD407DBC11');
        $this->addSql('ALTER TABLE arrondissement_demandes DROP CONSTRAINT FK_2D5B60BDF49DCC2D');
        $this->addSql('ALTER TABLE locataire DROP CONSTRAINT FK_C47CF6EBB7D53CFE');
        $this->addSql('ALTER TABLE demandes DROP CONSTRAINT FK_BD940CBB99DED506');
        $this->addSql('ALTER TABLE visite DROP CONSTRAINT FK_B09C8CBB99DED506');
        $this->addSql('DROP SEQUENCE personne_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE appartement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE photo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE arrondissement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE demandes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE banque_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE visite_id_seq CASCADE');
        $this->addSql('CREATE TABLE test2 (id INT NOT NULL, libelle VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE test1 (id INT NOT NULL, id_test2 INT DEFAULT NULL, libelle VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8AB2DCE2FD3ECC68 ON test1 (id_test2)');
        $this->addSql('ALTER TABLE test1 ADD CONSTRAINT id_test2 FOREIGN KEY (id_test2) REFERENCES test2 (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE admin_appartement');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE locataire');
        $this->addSql('DROP TABLE arrondissement');
        $this->addSql('DROP TABLE arrondissement_demandes');
        $this->addSql('DROP TABLE demandes');
        $this->addSql('DROP TABLE banque');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE client');
    }
}
