<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuCateg", mappedBy="menu")
     */
    private $categs;

    public function __construct()
    {
        $this->categs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|MenuCateg[]
     */
    public function getCategs(): Collection
    {
        return $this->categs;
    }

    public function addCateg(MenuCateg $categ): self
    {
        if (!$this->categs->contains($categ)) {
            $this->categs[] = $categ;
            $categ->setMenu($this);
        }

        return $this;
    }

    public function removeCateg(MenuCateg $categ): self
    {
        if ($this->categs->contains($categ)) {
            $this->categs->removeElement($categ);
            // set the owning side to null (unless already changed)
            if ($categ->getMenu() === $this) {
                $categ->setMenu(null);
            }
        }

        return $this;
    }
}
