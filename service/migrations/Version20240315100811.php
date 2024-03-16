<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240315100811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tv_show (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(200) NOT NULL, genre VARCHAR(200) NOT NULL, channel VARCHAR(200) NOT NULL, INDEX idx_tv_show_title (title), INDEX idx_tv_show_channel (channel), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_interval (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT NOT NULL, week_day INT NOT NULL, show_time INT NOT NULL, INDEX IDX_9D038D585E3A35BB (tv_show_id), INDEX idx_tv_show_interval_week_day (week_day), INDEX idx_tv_show_interval_show_time (show_time), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tv_show_interval ADD CONSTRAINT FK_9D038D585E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tv_show_interval DROP FOREIGN KEY FK_9D038D585E3A35BB');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE tv_show_interval');
    }
}
