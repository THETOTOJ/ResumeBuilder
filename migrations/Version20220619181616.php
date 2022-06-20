<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220619181616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE languages_user (languages_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DF80674E5D237A9A (languages_id), INDEX IDX_DF80674EA76ED395 (user_id), PRIMARY KEY(languages_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE languages_user ADD CONSTRAINT FK_DF80674E5D237A9A FOREIGN KEY (languages_id) REFERENCES languages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE languages_user ADD CONSTRAINT FK_DF80674EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE languages_user');
    }
}
