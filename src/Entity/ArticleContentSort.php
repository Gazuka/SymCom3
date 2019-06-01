<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class ArticleContentSort
{
    protected $position;

    protected function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getClass()
    {
        return str_replace("App\Entity\ArticleContent", "", get_class($this));
    }
}
