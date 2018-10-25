<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181024110522 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE riddle_likes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE riddle_likes (id INT NOT NULL, riddle_id_id INT NOT NULL, profile_id_id INT NOT NULL, liked BOOLEAN DEFAULT NULL, disliked BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6D44D0EF5BCA00C5 ON riddle_likes (riddle_id_id)');
        $this->addSql('CREATE INDEX IDX_6D44D0EF88900185 ON riddle_likes (profile_id_id)');
        $this->addSql('ALTER TABLE riddle_likes ADD CONSTRAINT FK_6D44D0EF5BCA00C5 FOREIGN KEY (riddle_id_id) REFERENCES riddle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE riddle_likes ADD CONSTRAINT FK_6D44D0EF88900185 FOREIGN KEY (profile_id_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE riddle_likes_id_seq CASCADE');
        $this->addSql('DROP TABLE riddle_likes');
    }
}
