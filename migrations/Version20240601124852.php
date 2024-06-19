<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601124852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE login (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, haslo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, typ VARCHAR(255) NOT NULL, producent VARCHAR(255) NOT NULL, system_operacyjny VARCHAR(50) DEFAULT NULL, cpu VARCHAR(255) DEFAULT NULL, ram VARCHAR(20) DEFAULT NULL, dysk INT DEFAULT NULL, przeznaczenie VARCHAR(255) DEFAULT NULL, ilosc_ogolna INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE obrazki (id INT AUTO_INCREMENT NOT NULL, id_modelu INT NOT NULL, nazwa VARCHAR(100) NOT NULL, obraz VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprzet (id INT AUTO_INCREMENT NOT NULL, hostname VARCHAR(255) NOT NULL, id_modelu INT NOT NULL, typ VARCHAR(100) NOT NULL, producent VARCHAR(100) NOT NULL, nazwa VARCHAR(255) NOT NULL, przeznaczenie VARCHAR(100) NOT NULL, cpu VARCHAR(255) DEFAULT NULL, ram INT DEFAULT NULL, dysk VARCHAR(255) DEFAULT NULL, system_operacyjny VARCHAR(255) DEFAULT NULL, id_uzytkownika INT DEFAULT NULL, przypisany_uzytkownik VARCHAR(255) DEFAULT NULL, lokalizacja VARCHAR(255) DEFAULT NULL, stanowisko VARCHAR(255) DEFAULT NULL, nr_tel INT DEFAULT NULL, data_wydania VARCHAR(100) DEFAULT NULL, data_zakupu VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzytkownicy (id INT AUTO_INCREMENT NOT NULL, imie_nazwisko VARCHAR(255) NOT NULL, lokalizacja VARCHAR(255) NOT NULL, stanowisko VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE login');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE obrazki');
        $this->addSql('DROP TABLE sprzet');
        $this->addSql('DROP TABLE uzytkownicy');
    }
}
