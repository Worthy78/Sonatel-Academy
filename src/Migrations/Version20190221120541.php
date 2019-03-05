<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221120541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cohorte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, promotion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX IDX_C4EB462E180AA129 ON apprenant');
        $this->addSql('ALTER TABLE apprenant CHANGE filiere_id fili�ere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EFB30EFA4 FOREIGN KEY (cohorte_id) REFERENCES cohorte (id)');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462E868DACD9 FOREIGN KEY (fili�ere_id) REFERENCES filiere (id)');
        $this->addSql('CREATE INDEX IDX_C4EB462E868DACD9 ON apprenant (fili�ere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EFB30EFA4');
        $this->addSql('DROP TABLE cohorte');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462E868DACD9');
        $this->addSql('DROP INDEX IDX_C4EB462E868DACD9 ON apprenant');
        $this->addSql('ALTER TABLE apprenant CHANGE fili�ere_id filiere_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_C4EB462E180AA129 ON apprenant (filiere_id)');
    }
}
