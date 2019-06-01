<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class ArticleContentSort
{
    protected $position;

    protected $nbrColSm;
    protected $nbrColMd;
    protected $nbrColLg;
    protected $nbrColXl;

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getNbrColSm(): ?int
    {
        return $this->nbrColSm;
    }

    public function setNbrColSm(int $nbrColSm): self
    {
        $this->nbrColSm = $nbrColSm;

        return $this;
    }

    public function getNbrColMd(): ?int
    {
        return $this->nbrColMd;
    }

    public function setNbrColMd(int $nbrColMd): self
    {
        $this->nbrColMd = $nbrColMd;

        return $this;
    }

    public function getNbrColLg(): ?int
    {
        return $this->nbrColLg;
    }

    public function setNbrColLg(int $nbrColLg): self
    {
        $this->nbrColLg = $nbrColLg;

        return $this;
    }

    public function getNbrColXl(): ?int
    {
        return $this->nbrColXl;
    }

    public function setNbrColXl(int $nbrColXl): self
    {
        $this->nbrColXl = $nbrColXl;

        return $this;
    }

    public function getClass()
    {
        return str_replace("App\Entity\ArticleContent", "", get_class($this));
    }
}
