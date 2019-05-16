<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonnelController extends AbstractController
{
    /**
     * @Route("/personnel", name="personnel")
     */
    public function index()
    {
        return $this->render('personnel/index.html.twig', [
            'controller_name' => 'PersonnelController',
        ]);
    }
}
