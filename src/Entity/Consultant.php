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

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, DomaineExpertise>
     */
    #[ORM\OneToMany(
        mappedBy: 'consultant',
        targetEntity: DomaineExpertise::class,
        orphanRemoval: false
    )]
    private Collection $domainExpertises;

    public function __construct()
    {
        $this->domainExpertises = new ArrayCollection();
    }

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

    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;

        if (null !== $file) {
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection<int, DomaineExpertise>
     */
    public function getDomainExpertises(): Collection
    {
        return $this->domainExpertises;
    }

    public function addDomainExpertise(DomaineExpertise $domainExpertise): static
    {
        if (!$this->domainExpertises->contains($domainExpertise)) {
            $this->domainExpertises->add($domainExpertise);
            $domainExpertise->setConsultant($this);
        }

        return $this;
    }

    public function removeDomainExpertise(DomaineExpertise $domainExpertise): static
    {
        if ($this->domainExpertises->removeElement($domainExpertise)) {
            if ($domainExpertise->getConsultant() === $this) {
                $domainExpertise->setConsultant(null);
            }
        }

        return $this;
    }
}