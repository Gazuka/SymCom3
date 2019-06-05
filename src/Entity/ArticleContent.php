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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleContentImg", mappedBy="articleContent")
     */
    private $articleContentImgs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleContentJumbo", mappedBy="articleContent")
     */
    private $articleContentJumbos;

    public function __construct()
    {
        $this->articleContentCards = new ArrayCollection();
        $this->articleContentImgs = new ArrayCollection();
        $this->articleContentJumbos = new ArrayCollection();
        $this->refreshNbrContent();                
    }

    public function __toString()
    {
        return "Position n° ".$this->position;
    }

    private function refreshNbrContent()
    {
        // Boucler sur tous les éléments possibles
        $this->nbrContent = sizeof($this->articleContentCards) + sizeof($this->articleContentImgs) + sizeof($this->articleContentJumbos);
    }

    private function refreshContenu()
    {
        $this->contenu = array();
        // Boucler sur tous les éléments possibles
        foreach($this->articleContentCards as $articleContentCard)
        {
            array_push($this->contenu, $articleContentCard);
        }
        foreach($this->articleContentImgs as $articleContentImg)
        {
            array_push($this->contenu, $articleContentImg);
        }
        foreach($this->articleContentJumbos as $articleContentJumbo)
        {
            array_push($this->contenu, $articleContentJumbo);
        }
        usort($this->contenu, array($this, "orderByPosition"));        
    }

    private function orderByPosition($a, $b)
    {
        //retourner 0 en cas d'égalité
        if ($a->getPosition() == $b->getPosition()) 
        {
            return 0;
        }
        else if ($a->getPosition() < $b->getPosition())
        {//retourner -1 en cas d’infériorité
            return -1;
        }
        else {//retourner 1 en cas de supériorité 
            return 1;
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
     * @return Collection|ArticleContentImg[]
     */
    public function getArticleContentImgs(): Collection
    {
        return $this->articleContentImgs;
    }

    public function addArticleContentImg(ArticleContentImg $articleContentImg): self
    {
        if (!$this->articleContentImgs->contains($articleContentImg)) {
            $this->articleContentImgs[] = $articleContentImg;
            $articleContentImg->setArticleContent($this);
        }

        return $this;
    }

    public function removeArticleContentImg(ArticleContentImg $articleContentImg): self
    {
        if ($this->articleContentImgs->contains($articleContentImg)) {
            $this->articleContentImgs->removeElement($articleContentImg);
            // set the owning side to null (unless already changed)
            if ($articleContentImg->getArticleContent() === $this) {
                $articleContentImg->setArticleContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ArticleContentJumbo[]
     */
    public function getArticleContentJumbos(): Collection
    {
        return $this->articleContentJumbos;
    }

    public function addArticleContentJumbo(ArticleContentJumbo $articleContentJumbo): self
    {
        if (!$this->articleContentJumbos->contains($articleContentJumbo)) {
            $this->articleContentJumbos[] = $articleContentJumbo;
            $articleContentJumbo->setArticleContent($this);
        }

        return $this;
    }

    public function removeArticleContentJumbo(ArticleContentJumbo $articleContentJumbo): self
    {
        if ($this->articleContentJumbos->contains($articleContentJumbo)) {
            $this->articleContentJumbos->removeElement($articleContentJumbo);
            // set the owning side to null (unless already changed)
            if ($articleContentJumbo->getArticleContent() === $this) {
                $articleContentJumbo->setArticleContent(null);
            }
        }

        return $this;
    }

}
