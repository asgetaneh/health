<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929043617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE misAinitiative_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_efa00030cb00d302cb09373b60067619_idx (type), INDEX object_id_efa00030cb00d302cb09373b60067619_idx (object_id), INDEX discriminator_efa00030cb00d302cb09373b60067619_idx (discriminator), INDEX transaction_hash_efa00030cb00d302cb09373b60067619_idx (transaction_hash), INDEX blame_id_efa00030cb00d302cb09373b60067619_idx (blame_id), INDEX created_at_efa00030cb00d302cb09373b60067619_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE misAoperational_planning_accomplishment_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (type), INDEX object_id_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (object_id), INDEX discriminator_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (discriminator), INDEX transaction_hash_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (transaction_hash), INDEX blame_id_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (blame_id), INDEX created_at_cb61202bbe0b699e2b6c5f39aa2c13ee_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE misAplanning_accomplishment_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_93cdb434552c842c83d32349161ad594_idx (type), INDEX object_id_93cdb434552c842c83d32349161ad594_idx (object_id), INDEX discriminator_93cdb434552c842c83d32349161ad594_idx (discriminator), INDEX transaction_hash_93cdb434552c842c83d32349161ad594_idx (transaction_hash), INDEX blame_id_93cdb434552c842c83d32349161ad594_idx (blame_id), INDEX created_at_93cdb434552c842c83d32349161ad594_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE misAsuitable_initiative_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_379ce17ea13e27d7cccfec1610c762a9_idx (type), INDEX object_id_379ce17ea13e27d7cccfec1610c762a9_idx (object_id), INDEX discriminator_379ce17ea13e27d7cccfec1610c762a9_idx (discriminator), INDEX transaction_hash_379ce17ea13e27d7cccfec1610c762a9_idx (transaction_hash), INDEX blame_id_379ce17ea13e27d7cccfec1610c762a9_idx (blame_id), INDEX created_at_379ce17ea13e27d7cccfec1610c762a9_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE misAuser_info_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (type), INDEX object_id_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (object_id), INDEX discriminator_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (discriminator), INDEX transaction_hash_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (transaction_hash), INDEX blame_id_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (blame_id), INDEX created_at_c4e5d0c5aa7ddd9b72f341a0ad89af15_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE misAinitiative_audit');
        $this->addSql('DROP TABLE misAoperational_planning_accomplishment_audit');
        $this->addSql('DROP TABLE misAplanning_accomplishment_audit');
        $this->addSql('DROP TABLE misAsuitable_initiative_audit');
        $this->addSql('DROP TABLE misAuser_info_audit');
    }
}
