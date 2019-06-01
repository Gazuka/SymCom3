<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

use App\Entity\ArticleContentSort;
use App\Entity\ArticleContentCard;

class ContentSortExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('ContentSort', [$this, 'choisirSort'], ['is_safe' => ['html']])];
    }

    public function choisirSort($ContentSort)
    {
        $sort = $ContentSort->getClass();
        switch($sort)
        {
            case 'Card':
                return $this->Card($ContentSort);
            break;
        }
    }

    private function Edit($ContentSort)
    {
        return "<div class='text-right'><a href='#'><i class='fas fa-edit'></i></a></div>";
    }

    private function Card($ContentCard)
    {
        $col = "";
        dump($ContentCard->getNbrColSm());
        if($ContentCard->getNbrColSm()){$col .= " col-sm-".$ContentCard->getNbrColSm();}else{$col .= " col-sm-12";}
        if($ContentCard->getNbrColMd()){$col .= " col-md-".$ContentCard->getNbrColMd();}
        if($ContentCard->getNbrColLg()){$col .= " col-lg-".$ContentCard->getNbrColLg();}
        if($ContentCard->getNbrColXl()){$col .= " col-xl-".$ContentCard->getNbrColXl();}
        
        $html =
        "
        <div class='".$col."  mb-3'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>".$ContentCard->getTitre()."</h5>
                    <p class='card-text'>".$ContentCard->getContenu()."</p>                
                </div>
            </div>".
            $this->Edit($ContentCard)
        ."
        </div>
        ";

        return $html;
    }
}