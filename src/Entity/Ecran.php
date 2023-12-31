<?php

namespace App\Entity;

use App\Repository\EcranRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: EcranRepository::class)]
class Ecran
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\ManyToOne(inversedBy: 'ecrans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MarqueEcran $marqueEcran = null;

    #[ORM\ManyToOne(inversedBy: 'ecrans')]
    private ?Ordinateur $ordinateur = null;

    #[ORM\ManyToMany(targetEntity: Ordinateur::class, mappedBy: 'ecrans')]
    private Collection $yes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getMarqueEcran(): ?MarqueEcran
    {
        return $this->marqueEcran;
    }

    public function setMarqueEcran(?MarqueEcran $marqueEcran): static
    {
        $this->marqueEcran = $marqueEcran;

        return $this;
    }

    public function getOrdinateur(): ?Ordinateur
    {
        return $this->ordinateur;
    }

    public function setOrdinateur(?Ordinateur $ordinateur): static
    {
        $this->ordinateur = $ordinateur;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getMarqueEcran()->getNom() . ' ' . $this->getTaille() . '"';
    }

}
