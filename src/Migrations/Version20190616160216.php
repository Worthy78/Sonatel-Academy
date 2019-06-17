<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190616160216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, timer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_C242628180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, date DATETIME NOT NULL, lieu VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, cohorte_id INT NOT NULL, filiere_id INT NOT NULL, compte_id INT NOT NULL, cv VARCHAR(100) DEFAULT NULL, INDEX IDX_C4EB462EFB30EFA4 (cohorte_id), INDEX IDX_C4EB462E180AA129 (filiere_id), UNIQUE INDEX UNIQ_C4EB462EF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administration (id INT AUTO_INCREMENT NOT NULL, compte_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_9FDD0D18F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_cours (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) NOT NULL, nom VARCHAR(100) NOT NULL, adresse LONGTEXT NOT NULL, tel VARCHAR(25) NOT NULL, date_naiss DATETIME NOT NULL, sexe VARCHAR(25) NOT NULL, photo LONGTEXT DEFAULT NULL, matricule VARCHAR(12) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, compte_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_17A55299F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, module_id INT DEFAULT NULL, typecour_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, data DATETIME NOT NULL, contenu LONGTEXT NOT NULL, auteur VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_FDCA8C9CAFC2B591 (module_id), INDEX IDX_FDCA8C9C6D70A3B8 (typecour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cohorte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, promotion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE abonne_newlester (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EFB30EFA4 FOREIGN KEY (cohorte_id) REFERENCES cohorte (id)');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462E180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EF2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE administration ADD CONSTRAINT FK_9FDD0D18F2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE professeur ADD CONSTRAINT FK_17A55299F2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C6D70A3B8 FOREIGN KEY (typecour_id) REFERENCES type_cours (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628180AA129');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462E180AA129');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CAFC2B591');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C6D70A3B8');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EF2C56620');
        $this->addSql('ALTER TABLE administration DROP FOREIGN KEY FK_9FDD0D18F2C56620');
        $this->addSql('ALTER TABLE professeur DROP FOREIGN KEY FK_17A55299F2C56620');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EFB30EFA4');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE apprenant');
        $this->addSql('DROP TABLE administration');
        $this->addSql('DROP TABLE type_cours');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE cohorte');
        $this->addSql('DROP TABLE abonne_newlester');
    }
}
