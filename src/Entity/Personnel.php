<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnelRepository")
 */
class Personnel
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
     * @ORM\ManyToMany(targetEntity="App\Entity\PersonnelTelephone", mappedBy="personnels")
     */
    private $telephones;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PersonnelMail", mappedBy="personnels")
     */
    private $mails;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PersonnelFonction", mappedBy="personnels")
     */
    private $fonctions;

    public function __construct()
    {
        $this->telephones = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->fonctions = new ArrayCollection();
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

    /**
     * @return Collection|PersonnelTelephone[]
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(PersonnelTelephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones[] = $telephone;
            $telephone->addPersonnel($this);
        }

        return $this;
    }

    public function removeTelephone(PersonnelTelephone $telephone): self
    {
        if ($this->telephones->contains($telephone)) {
            $this->telephones->removeElement($telephone);
            $telephone->removePersonnel($this);
        }

        return $this;
    }

    /**
     * @return Collection|PersonnelMail[]
     */
    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function addMail(PersonnelMail $mail): self
    {
        if (!$this->mails->contains($mail)) {
            $this->mails[] = $mail;
            $mail->addPersonnel($this);
        }

        return $this;
    }

    public function removeMail(PersonnelMail $mail): self
    {
        if ($this->mails->contains($mail)) {
            $this->mails->removeElement($mail);
            $mail->removePersonnel($this);
        }

        return $this;
    }

    /**
     * @return Collection|PersonnelFonction[]
     */
    public function getFonctions(): Collection
    {
        return $this->fonctions;
    }

    public function addFonction(PersonnelFonction $fonction): self
    {
        if (!$this->fonctions->contains($fonction)) {
            $this->fonctions[] = $fonction;
            $fonction->addPersonnel($this);
        }

        return $this;
    }

    public function removeFonction(PersonnelFonction $fonction): self
    {
        if ($this->fonctions->contains($fonction)) {
            $this->fonctions->removeElement($fonction);
            $fonction->removePersonnel($this);
        }

        return $this;
    }
}
