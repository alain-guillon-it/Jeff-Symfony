<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221155547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE User CHANGE genre genre_id INT NOT NULL');
        $this->addSql('ALTER TABLE User ADD CONSTRAINT FK_8D93D6494296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494296D31F ON User (genre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494296D31F');
        $this->addSql('DROP INDEX IDX_8D93D6494296D31F ON user');
        $this->addSql('ALTER TABLE user CHANGE genre_id genre INT NOT NULL');
    }
}
