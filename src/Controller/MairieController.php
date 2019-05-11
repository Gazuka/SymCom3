<?php

namespace App\Controller;

use App\Entity\Agenda;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MairieController extends AbstractController
{
    /**
     * @Route("/", name="mairie")
     */
    public function index()
    {
        //Récupération du repo de l'agenda
        $repo = $this->getDoctrine()->getRepository(Agenda::class);
        $agenda = $repo->findOneBy(array('nom' => 'Guesnain')); 

        return $this->render('mairie/index.html.twig', [
            'controller_name' => 'MairieController',
            'agenda' => $agenda
        ]);
    }
}