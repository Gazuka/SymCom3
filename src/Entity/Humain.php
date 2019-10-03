<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HumainRepository")
 */
class Humain
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Photo", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Telephone", mappedBy="humain")
     */
    private $telephones;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Email", mappedBy="humain")
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mission", mappedBy="humain")
     */
    private $missions;

    public function __construct()
    {
        $this->telephones = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom." ".$this->prenom;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Telephone[]
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(Telephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones[] = $telephone;
            $telephone->addHumain($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->contains($telephone)) {
            $this->telephones->removeElement($telephone);
            $telephone->removeHumain($this);
        }

        return $this;
    }

    /**
     * @return Collection|Email[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->addHumain($this);
        }

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            $email->removeHumain($this);
        }

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setHumain($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        dump('test');
        die();
        if ($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if ($mission->getHumain() === $this) {
                $mission->setHumain(null);
            }
        }

        return $this;
    }
}
