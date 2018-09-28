<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180927200628 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491FDF8D00');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497F37D8B4');
        $this->addSql('DROP INDEX IDX_8D93D6497F37D8B4 ON user');
        $this->addSql('DROP INDEX IDX_8D93D6491FDF8D00 ON user');
        $this->addSql('ALTER TABLE user DROP grupo_colegio_id, DROP grupo_universidad_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD grupo_colegio_id INT DEFAULT NULL, ADD grupo_universidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491FDF8D00 FOREIGN KEY (grupo_universidad_id) REFERENCES grupo (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497F37D8B4 FOREIGN KEY (grupo_colegio_id) REFERENCES grupo_colegio (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6497F37D8B4 ON user (grupo_colegio_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491FDF8D00 ON user (grupo_universidad_id)');
    }
}
