<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Introduction = null;

    #[ORM\Column(length: 255)]
    private ?string $nbrConsultant = null;

    #[ORM\Column(length: 255)]
    private ?string $chiffredaffaires = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->Introduction;
    }

    public function setIntroduction(string $Introduction): static
    {
        $this->Introduction = $Introduction;

        return $this;
    }

    public function getNbrConsultant(): ?string
    {
        return $this->nbrConsultant;
    }

    public function setNbrConsultant(string $nbrConsultant): static
    {
        $this->nbrConsultant = $nbrConsultant;

        return $this;
    }

    public function getChiffredaffaires(): ?string
    {
        return $this->chiffredaffaires;
    }

    public function setChiffredaffaires(string $chiffredaffaires): static
    {
        $this->chiffredaffaires = $chiffredaffaires;

        return $this;
    }
}
