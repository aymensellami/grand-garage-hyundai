<?php

namespace App\Entity;

use App\Repository\ConsultantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ConsultantRepository::class)]
#[Vich\Uploadable]

class Consultant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $pernon = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $exprience = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;
    #[Vich\UploadableField(mapping: 'team', fileNameProperty: 'file')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $domaine = null;

    
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

    public function getPernon(): ?string
    {
        return $this->pernon;
    }

    public function setPernon(string $pernon): static
    {
        $this->pernon = $pernon;

        return $this;
    }

    public function getExprience(): ?string
    {
        return $this->exprience;
    }

    public function setExprience(string $exprience): static
    {
        $this->exprience = $exprience;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): static
    {
        $this->file = $file;

        return $this;
    }
    public function setImageFile(?File $file= null): void
    {
        $this->imageFile = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): static
    {
        $this->domaine = $domaine;

        return $this;
    }

    
}
