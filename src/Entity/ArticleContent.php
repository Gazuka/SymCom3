<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleContentRepository")
 */
class ArticleContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleContentCard", mappedBy="articleContent")
     */
    private $articleContentCards;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="articleContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    private $nbrContent;

    private $contenu;

    public function __construct()
    {
        $this->articleContentCards = new ArrayCollection();
        $this->refreshNbrContent();
    }

    public function __toString()
    {
        return "Position n° ".$this->position;
    }

    private function refreshNbrContent()
    {
        // Boucler sur tous les éléments possibles
        $this->nbrContent = sizeof($this->articleContentCards);
    }

    private function refreshContenu()
    {
        $this->contenu = array();
        // Boucler sur tous les éléments possibles
        foreach($this->articleContentCards as $articleContentCard)
        {
            array_push($this->contenu, $articleContentCard);
        }
    }

    public function getContenu()
    {
        $this->refreshContenu();
        return $this->contenu;
    }

    public function getNbrContent(): ?int
    {
        $this->refreshNbrContent();
        return $this->nbrContent;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|ArticleContentCard[]
     */
    public function getArticleContentCards(): Collection
    {
        return $this->articleContentCards;
    }

    public function addArticleContentCard(ArticleContentCard $articleContentCard): self
    {
        if (!$this->articleContentCards->contains($articleContentCard)) {
            $this->articleContentCards[] = $articleContentCard;
            $articleContentCard->setArticleContent($this);
        }

        return $this;
    }

    public function removeArticleContentCard(ArticleContentCard $articleContentCard): self
    {
        if ($this->articleContentCards->contains($articleContentCard)) {
            $this->articleContentCards->removeElement($articleContentCard);
            // set the owning side to null (unless already changed)
            if ($articleContentCard->getArticleContent() === $this) {
                $articleContentCard->setArticleContent(null);
            }
        }

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

}
