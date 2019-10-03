<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TelephoneRepository")
 */
class Telephone
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
    private $numero;

    /**
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Humain", inversedBy="telephones")
     */
    private $humain;

    public function __construct()
    {
        $this->humain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return Collection|Humain[]
     */
    public function getHumain(): Collection
    {
        return $this->humain;
    }

    public function addHumain(Humain $humain): self
    {
        if (!$this->humain->contains($humain)) {
            $this->humain[] = $humain;
        }

        return $this;
    }

    public function removeHumain(Humain $humain): self
    {
        if ($this->humain->contains($humain)) {
            $this->humain->removeElement($humain);
        }

        return $this;
    }    
}