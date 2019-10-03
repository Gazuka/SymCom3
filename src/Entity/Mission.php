<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionRepository")
 */
class Mission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Humain", inversedBy="missions")
     */
    private $humain;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Structure", inversedBy="missions")
     */
    private $structure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fonction", inversedBy="missions")
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Association", inversedBy="missions")
     */
    private $association;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHumain(): ?Humain
    {
        return $this->humain;
    }

    public function setHumain(?Humain $humain): self
    {
        $this->humain = $humain;

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
    
    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }
}
