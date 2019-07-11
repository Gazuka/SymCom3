<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

use App\Entity\ArticleContentSort;
use App\Entity\ArticleContentCard;
use App\Entity\ArticleContentImg;
use App\Entity\ArticleContentJumbo;

class ContentSortExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('ContentSort', [$this, 'choisirSort'], ['is_safe' => ['html', 'twig']])];
    }

    public function choisirSort($ContentSort)
    {
        $sort = $ContentSort->getClass();
        switch($sort)
        {
            case 'Card':
                return $this->Card($ContentSort);
            break;
            case 'Img':
                return $this->Img($ContentSort);
            break;
            case 'Jumbo':
                return $this->Jumbo($ContentSort);
            break;
        }
    }

    private function Edit($ContentSort)
    {
        return "<div class='text-right'><a class='text-white' href='/admin/admin_article/".strtolower($ContentSort->getClass())."/".$ContentSort->getId()."/edit'><i class='fas fa-edit'></i></a></div>";
    }
    private function Delete($ContentSort)
    {
        return "<div class='text-right'><a class='confirmModalLink text-danger' href='/admin/admin_article/".strtolower($ContentSort->getClass())."/".$ContentSort->getId()."/delete'><i class='fas fa-trash-alt'></i></a></div>";
    }

    private function Size($ContentSort)
    {
        $col = "";
        if($ContentSort->getNbrColSm()){$col .= " col-sm-".$ContentSort->getNbrColSm();}else{$col .= " col-sm-12";}
        if($ContentSort->getNbrColMd()){$col .= " col-md-".$ContentSort->getNbrColMd();}
        if($ContentSort->getNbrColLg()){$col .= " col-lg-".$ContentSort->getNbrColLg();}
        if($ContentSort->getNbrColXl()){$col .= " col-xl-".$ContentSort->getNbrColXl();}
        return $col;
    }

    private function Card($ContentCard)
    {
        $col = $this->Size($ContentCard);
        
        $html =
        "
        <div class='".$col."  mb-3'>
            <div class='card'>
                <h5 class='card-header'>".$ContentCard->getTitre()."</h5>
                <div class='card-body text-justify'>                    
                    <p class='card-text'>".$ContentCard->getContenu()."</p>                
                </div>
            </div>".
            $this->Edit($ContentCard).$this->Delete($ContentCard)
        ."
        </div>
        ";

        return $html;
    }

    private function Img($ContentImg)
    {
        $col = $this->Size($ContentImg);
        $html =
        "
        <div class='".$col."  mb-3'>
            <img src='\img\articles\\".$ContentImg->getUrl()."' class='rounded float-left img-fluid' alt='".$ContentImg->getTitre()."'>".
            
            $this->Edit($ContentImg).$this->Delete($ContentImg)
        ."
        </div>
        ";

        return $html;
    }

    private function Jumbo($ContentJumbo)
    {
        $col = $this->Size($ContentJumbo);
        
        $html =
        "
        <div class='".$col."  mb-3'>
            <div class='jumbotron m-3'>";
        if($ContentJumbo->getTitreVisibility() == true)
        {
            $html .= "<h1 class='display-4'>".$ContentJumbo->getTitre()."</h1>";
        }
                
        $html .=
        "        <p class='lead'>".$ContentJumbo->getIntro()."</p>
                <hr class='my-4'>
                <p>".$ContentJumbo->getContenu()."</p>                
            </div>".
            $this->Edit($ContentJumbo).$this->Delete($ContentJumbo)."
            </div>
        ";

        return $html;
    }
}