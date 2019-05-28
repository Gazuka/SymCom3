<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HoraireOuvertureRepository")
 */
class HoraireOuverture
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
    private $jour;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heureFin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Horaire", inversedBy="Ouvertures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $horaire;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebut2;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFin2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getHoraire(): ?Horaire
    {
        return $this->horaire;
    }

    public function setHoraire(?Horaire $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getHeureDebut2(): ?\DateTimeInterface
    {
        return $this->heureDebut2;
    }

    public function setHeureDebut2(?\DateTimeInterface $heureDebut2): self
    {
        $this->heureDebut2 = $heureDebut2;

        return $this;
    }

    public function getHeureFin2(): ?\DateTimeInterface
    {
        return $this->heureFin2;
    }

    public function setHeureFin2(?\DateTimeInterface $heureFin2): self
    {
        $this->heureFin2 = $heureFin2;

        return $this;
    }
}
