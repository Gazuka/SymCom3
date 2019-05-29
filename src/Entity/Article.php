<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateStop;

    /**
     * @ORM\Column(type="boolean")
     */
    private $publie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accueil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageIntro;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleContent", mappedBy="article")
     */
    private $articleContents;

    public function __construct()
    {
        $this->articleContents = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateStop(): ?\DateTimeInterface
    {
        return $this->dateStop;
    }

    public function setDateStop(?\DateTimeInterface $dateStop): self
    {
        $this->dateStop = $dateStop;

        return $this;
    }

    public function getPublie(): ?bool
    {
        return $this->publie;
    }

    public function setPublie(bool $publie): self
    {
        $this->publie = $publie;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getAccueil(): ?bool
    {
        return $this->accueil;
    }

    public function setAccueil(bool $accueil): self
    {
        $this->accueil = $accueil;

        return $this;
    }

    public function getImageIntro(): ?string
    {
        return $this->imageIntro;
    }

    public function setImageIntro(?string $imageIntro): self
    {
        $this->imageIntro = $imageIntro;

        return $this;
    }

    /**
     * @return Collection|ArticleContent[]
     */
    public function getArticleContents(): Collection
    {
        return $this->articleContents;
    }

    public function addArticleContent(ArticleContent $articleContent): self
    {
        if (!$this->articleContents->contains($articleContent)) {
            $this->articleContents[] = $articleContent;
            $articleContent->setArticle($this);
        }

        return $this;
    }

    public function removeArticleContent(ArticleContent $articleContent): self
    {
        if ($this->articleContents->contains($articleContent)) {
            $this->articleContents->removeElement($articleContent);
            // set the owning side to null (unless already changed)
            if ($articleContent->getArticle() === $this) {
                $articleContent->setArticle(null);
            }
        }

        return $this;
    }
}
