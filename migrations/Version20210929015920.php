<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929015920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE initiative DROP FOREIGN KEY FK_E115DEFEC54C8C93');
        $this->addSql('DROP TABLE initiative_attribute_translation');
        $this->addSql('DROP TABLE initiative_initiative_behaviour');
        $this->addSql('DROP TABLE initiative_type');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE initiative_attribute_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, locale VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_38802182C2AC5D3 (translatable_id), UNIQUE INDEX initiative_attribute_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE initiative_initiative_behaviour (initiative_id INT NOT NULL, initiative_behaviour_id INT NOT NULL, INDEX IDX_BE3F2F1DAB7D9771 (initiative_id), INDEX IDX_BE3F2F1DFB8F377B (initiative_behaviour_id), PRIMARY KEY(initiative_id, initiative_behaviour_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE initiative_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE initiative_attribute_translation ADD CONSTRAINT FK_38802182C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES initiative_attribute (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE initiative_initiative_behaviour ADD CONSTRAINT FK_BE3F2F1DAB7D9771 FOREIGN KEY (initiative_id) REFERENCES initiative (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE initiative_initiative_behaviour ADD CONSTRAINT FK_BE3F2F1DFB8F377B FOREIGN KEY (initiative_behaviour_id) REFERENCES initiative_behaviour (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE initiative ADD CONSTRAINT FK_E115DEFEC54C8C93 FOREIGN KEY (category_id) REFERENCES initiative_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
