<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Entity\Menu;
use App\Entity\Agenda;
use App\Entity\Article;
use App\Entity\Personnel;
use App\Entity\Structure;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
        $this->structure['menu'] = $this->Menu('Guesnain');
        $this->structure['menurapide'] = $this->Menu('Rapide');
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
    private function Menu($titre)
    {
        $repo = $this->getDoctrine()->getRepository(Menu::class);
        return $repo->findOneBy(array('titre' => $titre));
    }

    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $this->StructureRender();        
        return $this->render('mairie/index.html.twig', $this->structure);
    }

    /**
     * @Route("public/", name="mairie")
     */
    public function accueil()
    {
        $this->StructureRender();        
        return $this->render('mairie/accueil.html.twig', $this->structure);
    }

    /**
     * @Route("public/municipalite", name="mairie_conseilmunicipal")
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
     * @Route("public/structure/{id}", name="mairie_structure")
     */
    public function structure($id)
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Structure::class);
        
        $structure = $repo->find($id);

        $this->structure['structure'] = $structure;
        return $this->render('mairie/structure.html.twig', $this->structure);
    }

    /**
     * @Route("public/article/{id}", name="mairie_article")
     */
    public function article($id)
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Article::class);
        
        $article = $repo->find($id);

        $this->structure['article'] = $article;
        return $this->render('mairie/article.html.twig', $this->structure);
    }

    /**
     * @Route("public/pdf/{type}", name="mairie_pdf")
     */
    public function pdf($type)
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Pdf::class);
        
        $PDFs = $repo->findBy(['type' => $type], ['date' => 'desc']);
        
        $this->structure['pdfs'] = $PDFs;
        return $this->render('mairie/'.$type.'.html.twig', $this->structure);
    }
}