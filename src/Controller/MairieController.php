<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Agenda;
use App\Entity\Personnel;
use App\Entity\Structure;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MairieController extends AbstractController
{
    private $structure;    
    
    /**
     * Création des variables utiles sur l'ensemble des pages
     */
    private function StructureRender()
    {
        $this->structure['agenda'] = $this->Agenda();
        $this->structure['menu'] = $this->Menu();
    }
    
    /**
     * Création de l'agenda
     */
    private function Agenda()
    {
        $repo = $this->getDoctrine()->getRepository(Agenda::class);
        return $repo->findOneBy(array('nom' => 'Guesnain'));
    }
    /**
     * Création du menu
     */
    private function Menu()
    {
        $repo = $this->getDoctrine()->getRepository(Menu::class);
        return $repo->findOneBy(array('titre' => 'Guesnain'));
    }

    /**
     * @Route("/", name="mairie")
     */
    public function index()
    {
        $this->StructureRender();        
        return $this->render('mairie/index.html.twig', $this->structure);
    }

    /**
     * @Route("/municipalite", name="mairie_conseilmunicipal")
     */
    public function conseilMunicipal()
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Personnel::class);
        
        $elus = $repo->findByElus('Conseil Municipal');

        $this->structure['elus'] = $elus;
        return $this->render('mairie/municipalite.html.twig', $this->structure);
    }

    /**
     * @Route("/structure/{id}", name="mairie_structure")
     */
    public function structure($id)
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Structure::class);
        
        $structure = $repo->find($id);

        $this->structure['structure'] = $structure;
        return $this->render('mairie/structure.html.twig', $this->structure);
    }
}