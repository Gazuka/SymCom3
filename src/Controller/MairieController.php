<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MairieController extends AbstractController
{
    /**
     * @Route("/", name="mairie")
     */
    public function index()
    {
        return $this->render('mairie/index.html.twig', [
            'controller_name' => 'MairieController',
        ]);
    }
}
