<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class PersonnelExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [new TwigFilter('Profil', [$this, 'vignette'], ['is_safe' => ['html', 'twig']])];
    }

    public function vignette($Profil)
    {
        $photo = $Profil->getPhoto();
        $photo = str_replace( '\\' , '/' , $photo);
        $html = '<div class="vignettePersonnel" style="background-image:url(src=/../../img/'.$photo.')"></div>';

        return $html;
    }
}