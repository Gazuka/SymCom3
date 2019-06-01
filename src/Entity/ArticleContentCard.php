<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ArticleContentSort;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleContentCardRepository")
 */
class ArticleContentCard extends ArticleContentSort
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
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleContent", inversedBy="articleContentCards")
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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

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
