<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929020627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE misAuser_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_eed3f63086f82491dea7cc5317373afe_idx (type), INDEX object_id_eed3f63086f82491dea7cc5317373afe_idx (object_id), INDEX discriminator_eed3f63086f82491dea7cc5317373afe_idx (discriminator), INDEX transaction_hash_eed3f63086f82491dea7cc5317373afe_idx (transaction_hash), INDEX blame_id_eed3f63086f82491dea7cc5317373afe_idx (blame_id), INDEX created_at_eed3f63086f82491dea7cc5317373afe_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE misAuser_group_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs LONGTEXT DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_b6db34ea68640c40f65fcbe8309c2fc4_idx (type), INDEX object_id_b6db34ea68640c40f65fcbe8309c2fc4_idx (object_id), INDEX discriminator_b6db34ea68640c40f65fcbe8309c2fc4_idx (discriminator), INDEX transaction_hash_b6db34ea68640c40f65fcbe8309c2fc4_idx (transaction_hash), INDEX blame_id_b6db34ea68640c40f65fcbe8309c2fc4_idx (blame_id), INDEX created_at_b6db34ea68640c40f65fcbe8309c2fc4_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE zzz_user_audit');
        $this->addSql('DROP TABLE zzz_user_group_audit');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE zzz_user_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, object_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, discriminator VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, transaction_hash VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, diffs LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user_fqdn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user_firewall VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ip VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX blame_id_a6cdc31cebad89a9db0f9daf19c57afb_idx (blame_id), INDEX created_at_a6cdc31cebad89a9db0f9daf19c57afb_idx (created_at), INDEX discriminator_a6cdc31cebad89a9db0f9daf19c57afb_idx (discriminator), INDEX object_id_a6cdc31cebad89a9db0f9daf19c57afb_idx (object_id), INDEX transaction_hash_a6cdc31cebad89a9db0f9daf19c57afb_idx (transaction_hash), INDEX type_a6cdc31cebad89a9db0f9daf19c57afb_idx (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE zzz_user_group_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, object_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, discriminator VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, transaction_hash VARCHAR(40) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, diffs LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user_fqdn VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, blame_user_firewall VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ip VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX blame_id_0be7c8db9d1a05c9ee29736d68942f11_idx (blame_id), INDEX created_at_0be7c8db9d1a05c9ee29736d68942f11_idx (created_at), INDEX discriminator_0be7c8db9d1a05c9ee29736d68942f11_idx (discriminator), INDEX object_id_0be7c8db9d1a05c9ee29736d68942f11_idx (object_id), INDEX transaction_hash_0be7c8db9d1a05c9ee29736d68942f11_idx (transaction_hash), INDEX type_0be7c8db9d1a05c9ee29736d68942f11_idx (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE misAuser_audit');
        $this->addSql('DROP TABLE misAuser_group_audit');
    }
}
