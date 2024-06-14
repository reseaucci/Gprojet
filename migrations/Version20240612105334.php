<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612105334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE conge (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, commentaire LONGTEXT DEFAULT NULL, utilisateur_id INT NOT NULL, INDEX IDX_2ED89348FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, date_creation DATETIME NOT NULL, date_echeance DATETIME NOT NULL, montant_ht NUMERIC(10, 2) NOT NULL, tva NUMERIC(10, 2) NOT NULL, montant_ttc NUMERIC(10, 2) NOT NULL, client_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, projet_id INT NOT NULL, INDEX IDX_8B27C52B19EB6921 (client_id), INDEX IDX_8B27C52B7F2DEE08 (facture_id), INDEX IDX_8B27C52BC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, numero_facture VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_echeance DATETIME NOT NULL, montant_ht NUMERIC(10, 2) NOT NULL, tva NUMERIC(10, 2) NOT NULL, montant_ttc NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fichier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, taille INT NOT NULL, type VARCHAR(255) NOT NULL, facture_id_id INT DEFAULT NULL, devis_id INT DEFAULT NULL, INDEX IDX_9B76551FED7016E0 (facture_id_id), INDEX IDX_9B76551F41DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE jalon (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_echeance DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ligne_devis (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, prix_unitaire_ht NUMERIC(10, 2) NOT NULL, montant_ht NUMERIC(10, 2) NOT NULL, devis_id INT NOT NULL, INDEX IDX_888B2F1B41DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ligne_facture (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, prix_unitaire_ht NUMERIC(10, 2) NOT NULL, montant_ht NUMERIC(10, 2) NOT NULL, facture_id_id INT DEFAULT NULL, INDEX IDX_611F5A29ED7016E0 (facture_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE probleme (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, priorite INT NOT NULL, statut VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_resolution DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, budget NUMERIC(10, 2) NOT NULL, responsable_id INT NOT NULL, statut VARCHAR(255) NOT NULL, budget_previsionnel NUMERIC(10, 2) NOT NULL, budget_reel NUMERIC(10, 2) NOT NULL, avancement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE projet_utilisateur (projet_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_C626378DC18272 (projet_id), INDEX IDX_C626378DFB88E14F (utilisateur_id), PRIMARY KEY(projet_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE responsable (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE risque (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, impact_potentiel INT NOT NULL, propabilite INT NOT NULL, plan_action LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, disponibilite LONGTEXT NOT NULL, commentaire_id INT DEFAULT NULL, INDEX IDX_1D1C63B3BA9CD190 (commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED89348FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FED7016E0 FOREIGN KEY (facture_id_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE ligne_devis ADD CONSTRAINT FK_888B2F1B41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE ligne_facture ADD CONSTRAINT FK_611F5A29ED7016E0 FOREIGN KEY (facture_id_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE projet_utilisateur ADD CONSTRAINT FK_C626378DC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_utilisateur ADD CONSTRAINT FK_C626378DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED89348FB88E14F');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B19EB6921');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B7F2DEE08');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC18272');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FED7016E0');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F41DEFADA');
        $this->addSql('ALTER TABLE ligne_devis DROP FOREIGN KEY FK_888B2F1B41DEFADA');
        $this->addSql('ALTER TABLE ligne_facture DROP FOREIGN KEY FK_611F5A29ED7016E0');
        $this->addSql('ALTER TABLE projet_utilisateur DROP FOREIGN KEY FK_C626378DC18272');
        $this->addSql('ALTER TABLE projet_utilisateur DROP FOREIGN KEY FK_C626378DFB88E14F');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3BA9CD190');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fichier');
        $this->addSql('DROP TABLE jalon');
        $this->addSql('DROP TABLE ligne_devis');
        $this->addSql('DROP TABLE ligne_facture');
        $this->addSql('DROP TABLE probleme');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE projet_utilisateur');
        $this->addSql('DROP TABLE responsable');
        $this->addSql('DROP TABLE risque');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE utilisateur');
    }
}
