<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240705013853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, file_md5 VARCHAR(32) NOT NULL UNIQUE, beatmapset_id INT NOT NULL, beatmap_id INT NOT NULL, title VARCHAR(1024) NOT NULL, title_unicode VARCHAR(1024) NOT NULL, artist VARCHAR(1024) NOT NULL, artist_unicode VARCHAR(1024) NOT NULL, version VARCHAR(1024) NOT NULL, mode SMALLINT NOT NULL, star_rating DOUBLE PRECISION NOT NULL, star_rating_half_time DOUBLE PRECISION NOT NULL, star_rating_double_time DOUBLE PRECISION NOT NULL, bpm DOUBLE PRECISION NOT NULL, max_combo INT NOT NULL, creator VARCHAR(255) NOT NULL, creator_id INT NOT NULL, submit_date DATETIME DEFAULT NULL, approved_date DATETIME DEFAULT NULL, last_update DATETIME DEFAULT NULL, count_normal INT NOT NULL, count_slider INT NOT NULL, count_spinner INT NOT NULL, tags VARCHAR(1024) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE queue_map (id INT AUTO_INCREMENT NOT NULL, file_md5 VARCHAR(32) NOT NULL, ts_created TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        
    }
}
