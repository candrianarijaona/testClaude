<?php

namespace App\Entity;

use App\Repository\OrdinateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: OrdinateurRepository::class)]
class Ordinateur
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nom;

    #[ORM\Column]
    private bool $statut = true;

    #[ORM\OneToMany(mappedBy: 'ordinateur', targetEntity: Ecran::class)]
    private Collection $ecrans;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Souris $souris = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tour $tour = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clavier $clavier = null;

    public function __construct()
    {
        $this->ecrans = new ArrayCollection();
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

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Ecran>
     */
    public function getEcrans(): Collection
    {
        return $this->ecrans;
    }

    public function addEcran(Ecran $ecran): static
    {
        if (!$this->ecrans->contains($ecran)) {
            $this->ecrans->add($ecran);
            $ecran->setOrdinateur($this);
        }

        return $this;
    }

    public function removeEcran(Ecran $ecran): static
    {
        if ($this->ecrans->removeElement($ecran)) {
            // set the owning side to null (unless already changed)
            if ($ecran->getOrdinateur() === $this) {
                $ecran->setOrdinateur(null);
            }
        }

        return $this;
    }

    public function getSouris(): ?Souris
    {
        return $this->souris;
    }

    public function setSouris(Souris $souris): static
    {
        $this->souris = $souris;

        return $this;
    }

    public function getTour(): ?Tour
    {
        return $this->tour;
    }

    public function setTour(Tour $tour): static
    {
        $this->tour = $tour;

        return $this;
    }

    public function getClavier(): ?Clavier
    {
        return $this->clavier;
    }

    public function setClavier(Clavier $clavier): static
    {
        $this->clavier = $clavier;

        return $this;
    }
}
