<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgendaRepository")
 */
class Agenda
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
     * @ORM\ManyToMany(targetEntity="App\Entity\AgendaEvent", inversedBy="agendas")
     */
    private $Events;

    public function __construct()
    {
        $this->Events = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->nom;
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

    /**
     * @return Collection|AgendaEvent[]
     */
    public function getEvents(): Collection
    {
        return $this->Events;
    }

    public function addEvent(AgendaEvent $event): self
    {
        if (!$this->Events->contains($event)) {
            $this->Events[] = $event;
        }

        return $this;
    }

    public function removeEvent(AgendaEvent $event): self
    {
        if ($this->Events->contains($event)) {
            $this->Events->removeElement($event);
        }

        return $this;
    }
}
