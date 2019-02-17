<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217190506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE battle CHANGE campaign_id campaign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE battle ADD CONSTRAINT FK_13991734F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('CREATE INDEX IDX_13991734F639F774 ON battle (campaign_id)');
        $this->addSql('ALTER TABLE battle_enemy CHANGE battle_id battle_id INT DEFAULT NULL, CHANGE monster_id monster_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE battle_enemy ADD CONSTRAINT FK_E2A40B1BC9732719 FOREIGN KEY (battle_id) REFERENCES battle (id)');
        $this->addSql('ALTER TABLE battle_enemy ADD CONSTRAINT FK_E2A40B1BC5FF1223 FOREIGN KEY (monster_id) REFERENCES monster (id)');
        $this->addSql('CREATE INDEX IDX_E2A40B1BC9732719 ON battle_enemy (battle_id)');
        $this->addSql('CREATE INDEX IDX_E2A40B1BC5FF1223 ON battle_enemy (monster_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE battle DROP FOREIGN KEY FK_13991734F639F774');
        $this->addSql('DROP INDEX IDX_13991734F639F774 ON battle');
        $this->addSql('ALTER TABLE battle CHANGE campaign_id campaign_id INT NOT NULL');
        $this->addSql('ALTER TABLE battle_enemy DROP FOREIGN KEY FK_E2A40B1BC9732719');
        $this->addSql('ALTER TABLE battle_enemy DROP FOREIGN KEY FK_E2A40B1BC5FF1223');
        $this->addSql('DROP INDEX IDX_E2A40B1BC9732719 ON battle_enemy');
        $this->addSql('DROP INDEX IDX_E2A40B1BC5FF1223 ON battle_enemy');
        $this->addSql('ALTER TABLE battle_enemy CHANGE battle_id battle_id INT NOT NULL, CHANGE monster_id monster_id INT NOT NULL');
    }
}
