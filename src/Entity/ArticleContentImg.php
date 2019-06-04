<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ArticleContentSort;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleContentImgRepository")
 */
class ArticleContentImg extends ArticleContentSort
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
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleContent", inversedBy="articleContentImgs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleContent;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
