<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219002022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE battle_enemy DROP FOREIGN KEY FK_E2A40B1BC5FF1223');
        $this->addSql('CREATE TABLE battle_champion (id INT AUTO_INCREMENT NOT NULL, battle_id INT DEFAULT NULL, champion_id INT DEFAULT NULL, max_health INT DEFAULT NULL, health INT DEFAULT NULL, attack INT DEFAULT NULL, defense INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_9132D1E2C9732719 (battle_id), INDEX IDX_9132D1E2FA7FD7EB (champion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, attack INT DEFAULT NULL, defense INT DEFAULT NULL, health INT DEFAULT NULL, sprite_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champion (id INT AUTO_INCREMENT NOT NULL, champion_id INT DEFAULT NULL, max_health INT DEFAULT NULL, health INT DEFAULT NULL, attack INT DEFAULT NULL, defense INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_45437EB4FA7FD7EB (champion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE battle_champion ADD CONSTRAINT FK_9132D1E2C9732719 FOREIGN KEY (battle_id) REFERENCES battle (id)');
        $this->addSql('ALTER TABLE battle_champion ADD CONSTRAINT FK_9132D1E2FA7FD7EB FOREIGN KEY (champion_id) REFERENCES creature (id)');
        $this->addSql('ALTER TABLE champion ADD CONSTRAINT FK_45437EB4FA7FD7EB FOREIGN KEY (champion_id) REFERENCES creature (id)');
        $this->addSql('DROP TABLE monster');
        $this->addSql('ALTER TABLE battle_enemy ADD CONSTRAINT FK_E2A40B1BC5FF1223 FOREIGN KEY (monster_id) REFERENCES creature (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE battle_champion DROP FOREIGN KEY FK_9132D1E2FA7FD7EB');
        $this->addSql('ALTER TABLE battle_enemy DROP FOREIGN KEY FK_E2A40B1BC5FF1223');
        $this->addSql('ALTER TABLE champion DROP FOREIGN KEY FK_45437EB4FA7FD7EB');
        $this->addSql('CREATE TABLE monster (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, attack INT DEFAULT NULL, defense INT DEFAULT NULL, health INT DEFAULT NULL, sprite_path VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE battle_champion');
        $this->addSql('DROP TABLE creature');
        $this->addSql('DROP TABLE champion');
        $this->addSql('ALTER TABLE battle_enemy ADD CONSTRAINT FK_E2A40B1BC5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
    }
}
