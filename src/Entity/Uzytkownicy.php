<?php

namespace App\Entity;

use App\Repository\UzytkownicyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UzytkownicyRepository::class)]
class Uzytkownicy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $imie_nazwisko = null;

    #[ORM\Column(length: 255)]
    private ?string $lokalizacja = null;

    #[ORM\Column(length: 255)]
    private ?string $stanowisko = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImieNazwisko(): ?string
    {
        return $this->imie_nazwisko;
    }

    public function setImieNazwisko(string $imie_nazwisko): static
    {
        $this->imie_nazwisko = $imie_nazwisko;

        return $this;
    }

    public function getLokalizacja(): ?string
    {
        return $this->lokalizacja;
    }

    public function setLokalizacja(string $lokalizacja): static
    {
        $this->lokalizacja = $lokalizacja;

        return $this;
    }

    public function getStanowisko(): ?string
    {
        return $this->stanowisko;
    }

    public function setStanowisko(string $stanowisko): static
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
}
