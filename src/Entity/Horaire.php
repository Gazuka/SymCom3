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
    private $ouvertures;

    public function __construct()
    {
        $this->ouvertures = new ArrayCollection();
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
        return $this->ouvertures;
    }

    public function addOuverture(HoraireOuverture $ouverture): self
    {
        if (!$this->ouvertures->contains($ouverture)) {
            $this->ouvertures[] = $ouverture;
            $ouverture->setHoraire($this);
        }

        return $this;
    }

    public function removeOuverture(HoraireOuverture $ouverture): self
    {
        if ($this->ouvertures->contains($ouverture)) {
            $this->ouvertures->removeElement($ouverture);
            // set the owning side to null (unless already changed)
            if ($ouverture->getHoraire() === $this) {
                $ouverture->setHoraire(null);
            }
        }

        return $this;
    }

    /**
     * Retourne false si l'horaire n'est pas actif, et le nombre de jour d'acitivité si l'horaire est actif
     */
    public function verifHoraireActif($dateVerif)
    {
        //if($this->dateDebut <= $dateVerif && $this->dateFin >= $dateVerif)
        $test1 = date_diff($this->dateDebut, $dateVerif)->format('%R%a');
        $test2 = date_diff($dateVerif, $this->dateFin)->format('%R%a');
        if( $test1 >= 0 &&  $test2 >= 0)
        {
            //Date active
            return date_diff($this->dateDebut, $this->dateFin)->format('%a');;
        }
        else
        {
            //Date hors de l'horaire            
            return false;
        }
    }
}

