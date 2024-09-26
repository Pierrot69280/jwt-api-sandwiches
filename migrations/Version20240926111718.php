<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926111718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ingredients_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sandwich_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ingredients (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ingredients_sandwich (ingredients_id INT NOT NULL, sandwich_id INT NOT NULL, PRIMARY KEY(ingredients_id, sandwich_id))');
        $this->addSql('CREATE INDEX IDX_F9F406213EC4DCE ON ingredients_sandwich (ingredients_id)');
        $this->addSql('CREATE INDEX IDX_F9F406214D566043 ON ingredients_sandwich (sandwich_id)');
        $this->addSql('CREATE TABLE sandwich (id INT NOT NULL, name TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE ingredients_sandwich ADD CONSTRAINT FK_F9F406213EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingredients_sandwich ADD CONSTRAINT FK_F9F406214D566043 FOREIGN KEY (sandwich_id) REFERENCES sandwich (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ingredients_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sandwich_id_seq CASCADE');
        $this->addSql('ALTER TABLE ingredients_sandwich DROP CONSTRAINT FK_F9F406213EC4DCE');
        $this->addSql('ALTER TABLE ingredients_sandwich DROP CONSTRAINT FK_F9F406214D566043');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE ingredients_sandwich');
        $this->addSql('DROP TABLE sandwich');
    }
}
