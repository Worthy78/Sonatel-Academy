<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401160307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462E180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EF2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C4EB462E180AA129 ON apprenant (filiere_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4EB462EF2C56620 ON apprenant (compte_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462E180AA129');
        $this->addSql('ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EF2C56620');
        $this->addSql('DROP INDEX IDX_C4EB462E180AA129 ON apprenant');
        $this->addSql('DROP INDEX UNIQ_C4EB462EF2C56620 ON apprenant');
    }
}
