<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229082524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor_movie (actor_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_39DA19FB10DAF24A (actor_id), INDEX IDX_39DA19FB8F93B6FC (movie_id), PRIMARY KEY(actor_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE director_movie (director_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_E7596DBD899FB366 (director_id), INDEX IDX_E7596DBD8F93B6FC (movie_id), PRIMARY KEY(director_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actor_movie ADD CONSTRAINT FK_39DA19FB8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE director_movie ADD CONSTRAINT FK_E7596DBD899FB366 FOREIGN KEY (director_id) REFERENCES director (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE director_movie ADD CONSTRAINT FK_E7596DBD8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD composer_id INT NOT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F7A8D2620 FOREIGN KEY (composer_id) REFERENCES composer (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F7A8D2620 ON movie (composer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB10DAF24A');
        $this->addSql('ALTER TABLE actor_movie DROP FOREIGN KEY FK_39DA19FB8F93B6FC');
        $this->addSql('ALTER TABLE director_movie DROP FOREIGN KEY FK_E7596DBD899FB366');
        $this->addSql('ALTER TABLE director_movie DROP FOREIGN KEY FK_E7596DBD8F93B6FC');
        $this->addSql('DROP TABLE actor_movie');
        $this->addSql('DROP TABLE director_movie');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F7A8D2620');
        $this->addSql('DROP INDEX IDX_1D5EF26F7A8D2620 ON movie');
        $this->addSql('ALTER TABLE movie DROP composer_id');
    }
}
