<?php

namespace App\Entity;

use App\Repository\SprzetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SprzetRepository::class)]
class Sprzet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hostname = null;

    #[ORM\Column]
    private ?int $id_modelu = null;

    #[ORM\Column(length: 100)]
    private ?string $typ = null;

    #[ORM\Column(length: 100)]
    private ?string $producent = null;

    #[ORM\Column(length: 255)]
    private ?string $nazwa = null;

    #[ORM\Column(length: 100)]
    private ?string $przeznaczenie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cpu = null;

    #[ORM\Column(nullable: true)]
    private ?int $ram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dysk = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $system_operacyjny = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_uzytkownika = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $przypisany_uzytkownik = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lokalizacja = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stanowisko = null;

    #[ORM\Column(nullable: true)]
    private ?int $nr_tel = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $data_wydania = null;

    #[ORM\Column(length: 100)]
    private ?string $data_zakupu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    public function setHostname(string $hostname): static
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getIdModelu(): ?int
    {
        return $this->id_modelu;
    }

    public function setIdModelu(int $id_modelu): static
    {
        $this->id_modelu = $id_modelu;

        return $this;
    }

    public function getTyp(): ?string
    {
        return $this->typ;
    }

    public function setTyp(string $typ): static
    {
        $this->typ = $typ;

        return $this;
    }

    public function getProducent(): ?string
    {
        return $this->producent;
    }

    public function setProducent(string $producent): static
    {
        $this->producent = $producent;

        return $this;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): static
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getPrzeznaczenie(): ?string
    {
        return $this->przeznaczenie;
    }

    public function setPrzeznaczenie(string $przeznaczenie): static
    {
        $this->przeznaczenie = $przeznaczenie;

        return $this;
    }

    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    public function setCpu(?string $cpu): static
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getRam(): ?int
    {
        return $this->ram;
    }

    public function setRam(?int $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getDysk(): ?string
    {
        return $this->dysk;
    }

    public function setDysk(?string $dysk): static
    {
        $this->dysk = $dysk;

        return $this;
    }

    public function getSystemOperacyjny(): ?string
    {
        return $this->system_operacyjny;
    }

    public function setSystemOperacyjny(?string $system_operacyjny): static
    {
        $this->system_operacyjny = $system_operacyjny;

        return $this;
    }

    public function getIdUzytkownika(): ?int
    {
        return $this->id_uzytkownika;
    }

    public function setIdUzytkownika(?int $id_uzytkownika): static
    {
        $this->id_uzytkownika = $id_uzytkownika;

        return $this;
    }

    public function getPrzypisanyUzytkownik(): ?string
    {
        return $this->przypisany_uzytkownik;
    }

    public function setPrzypisanyUzytkownik(?string $przypisany_uzytkownik): static
    {
        $this->przypisany_uzytkownik = $przypisany_uzytkownik;

        return $this;
    }

    public function getLokalizacja(): ?string
    {
        return $this->lokalizacja;
    }

    public function setLokalizacja(?string $lokalizacja): static
    {
        $this->lokalizacja = $lokalizacja;

        return $this;
    }

    public function getStanowisko(): ?string
    {
        return $this->stanowisko;
    }

    public function setStanowisko(?string $stanowisko): static
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    public function getNrTel(): ?int
    {
        return $this->nr_tel;
    }

    public function setNrTel(?int $nr_tel): static
    {
        $this->nr_tel = $nr_tel;

        return $this;
    }

    public function getDataWydania(): ?string
    {
        return $this->data_wydania;
    }

    public function setDataWydania(?string $data_wydania): static
    {
        $this->data_wydania = $data_wydania;

        return $this;
    }

    public function getDataZakupu(): ?string
    {
        return $this->data_zakupu;
    }

    public function setDataZakupu(string $data_zakupu): static
    {
        $this->data_zakupu = $data_zakupu;

        return $this;
    }
}
