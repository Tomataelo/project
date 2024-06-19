<?php

namespace App\Entity;

use App\Repository\ObrazkiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObrazkiRepository::class)]
class Obrazki
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_modelu = null;

    #[ORM\Column(length: 100)]
    private ?string $nazwa = null;

    #[ORM\Column(length: 255)]
    private ?string $obraz = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): static
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getObraz(): ?string
    {
        return $this->obraz;
    }

    public function setObraz(string $obraz): static
    {
        $this->obraz = $obraz;

        return $this;
    }
}
