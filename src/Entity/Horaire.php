<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HoraireRepository")
 */
class Horaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Structure", inversedBy="horaires")
     */
    private $structure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HoraireOuverture", mappedBy="horaire", orphanRemoval=true)
     */
    private $Ouvertures;

    public function __construct()
    {
        $this->Ouvertures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * @return Collection|HoraireOuverture[]
     */
    public function getOuvertures(): Collection
    {
        return $this->Ouvertures;
    }

    public function addOuverture(HoraireOuverture $ouverture): self
    {
        if (!$this->Ouvertures->contains($ouverture)) {
            $this->Ouvertures[] = $ouverture;
            $ouverture->setHoraire($this);
        }

        return $this;
    }

    public function removeOuverture(HoraireOuverture $ouverture): self
    {
        if ($this->Ouvertures->contains($ouverture)) {
            $this->Ouvertures->removeElement($ouverture);
            // set the owning side to null (unless already changed)
            if ($ouverture->getHoraire() === $this) {
                $ouverture->setHoraire(null);
            }
        }

        return $this;
    }
}
