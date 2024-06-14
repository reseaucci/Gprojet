<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612121357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED89348FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FED7016E0 FOREIGN KEY (facture_id_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE jalon ADD CONSTRAINT FK_9F9801E4C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE ligne_devis ADD CONSTRAINT FK_888B2F1B41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('DROP INDEX IDX_611F5A29ED7016E0 ON ligne_facture');
        $this->addSql('ALTER TABLE ligne_facture CHANGE facture_id_id facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_facture ADD CONSTRAINT FK_611F5A297F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_611F5A297F2DEE08 ON ligne_facture (facture_id)');
        $this->addSql('ALTER TABLE projet_utilisateur ADD CONSTRAINT FK_C626378DC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_utilisateur ADD CONSTRAINT FK_C626378DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B19EB6921');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B7F2DEE08');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC18272');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FED7016E0');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F41DEFADA');
        $this->addSql('ALTER TABLE projet_utilisateur DROP FOREIGN KEY FK_C626378DC18272');
        $this->addSql('ALTER TABLE projet_utilisateur DROP FOREIGN KEY FK_C626378DFB88E14F');
        $this->addSql('ALTER TABLE ligne_facture DROP FOREIGN KEY FK_611F5A297F2DEE08');
        $this->addSql('DROP INDEX IDX_611F5A297F2DEE08 ON ligne_facture');
        $this->addSql('ALTER TABLE ligne_facture CHANGE facture_id facture_id_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_611F5A29ED7016E0 ON ligne_facture (facture_id_id)');
        $this->addSql('ALTER TABLE ligne_devis DROP FOREIGN KEY FK_888B2F1B41DEFADA');
        $this->addSql('ALTER TABLE jalon DROP FOREIGN KEY FK_9F9801E4C18272');
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED89348FB88E14F');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3BA9CD190');
    }
}
