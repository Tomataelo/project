<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typ = null;

    #[ORM\Column(length: 255)]
    private ?string $nazwa = null;

    #[ORM\Column(length: 255)]
    private ?string $producent = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $system_operacyjny = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cpu = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $ram = null;

    #[ORM\Column(nullable: true)]
    private ?int $dysk = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $przeznaczenie = null;

    #[ORM\Column(nullable: true)]
    private ?int $ilosc_ogolna = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): static
    {
        $this->nazwa = $nazwa;

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

    public function getSystemOperacyjny(): ?string
    {
        return $this->system_operacyjny;
    }

    public function setSystemOperacyjny(?string $system_operacyjny): static
    {
        $this->system_operacyjny = $system_operacyjny;

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

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(?string $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getDysk(): ?int
    {
        return $this->dysk;
    }

    public function setDysk(?int $dysk): static
    {
        $this->dysk = $dysk;

        return $this;
    }

    public function getPrzeznaczenie(): ?string
    {
        return $this->przeznaczenie;
    }

    public function setPrzeznaczenie(?string $przeznaczenie): static
    {
        $this->przeznaczenie = $przeznaczenie;

        return $this;
    }

    public function getIloscOgolna(): ?int
    {
        return $this->ilosc_ogolna;
    }

    public function setIloscOgolna(?int $ilosc_ogolna): static
    {
        $this->ilosc_ogolna = $ilosc_ogolna;

        return $this;
    }
}
