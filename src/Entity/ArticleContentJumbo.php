<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ArticleContentSort;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleContentJumboRepository")
 */
class ArticleContentJumbo extends ArticleContentSort
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
     * @ORM\Column(type="boolean")
     */
    private $titreVisibility;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $intro;

    /**
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @ORM\Column(type="integer")
     */
    protected $nbrColSm;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $nbrColMd;

    /**
     * @ORM\Column(type="integer")
     */
    protected $nbrColLg;

    /**
     * @ORM\Column(type="integer")
     */
    protected $nbrColXl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleContent", inversedBy="articleContentJumbos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleContent;
    
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

    public function getTitreVisibility(): ?bool
    {
        return $this->titreVisibility;
    }

    public function setTitreVisibility(bool $titreVisibility): self
    {
        $this->titreVisibility = $titreVisibility;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(?string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getArticleContent(): ?ArticleContent
    {
        return $this->articleContent;
    }

    public function setArticleContent(?ArticleContent $articleContent): self
    {
        $this->articleContent = $articleContent;

        return $this;
    }
}
