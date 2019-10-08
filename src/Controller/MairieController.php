<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Entity\Menu;
use App\Entity\Agenda;
use App\Entity\Article;
use App\Entity\Personnel;
use App\Entity\Structure;
use App\Entity\Association;
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
     * @Route("public/commissions", name="mairie_commissionsmunicipales")
     */
    public function commissionsMunicipale()
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Personnel::class);
        
        $chefFinances = $repo->findByFonction('Chargé de la commission des Finances');
        $membresFinances = $repo->findByFonction('Membre de la commission des Finances');

        $chefEnfance = $repo->findByFonction('Chargé de la commission petite enfance et jeunesse');
        $membresEnfance = $repo->findByFonction('Membre de la commission petite enfance et jeunesse');

        $chefUrbanisme = $repo->findByFonction('Chargé de la commission urbanisme, politique de la ville et environnement');
        $membresUrbanisme = $repo->findByFonction('Membre de la commission urbanisme, politique de la ville et environnement');

        $chefCommunication = $repo->findByFonction('Déléguée de la commission communication');
        $membresCommunication = $repo->findByFonction('Membre de la commission communication');

        $chefFete = $repo->findByFonction('Déléguée de la commission culture, fêtes et cérémonies');
        $membresFete = $repo->findByFonction('Membre de la commission culture, fêtes et cérémonies');

        $chefTravaux = $repo->findByFonction('Déléguée de la commission travaux et sécurité');
        $membresTravaux = $repo->findByFonction('Membre de la commission travaux et sécurité');

        $chefSport = $repo->findByFonction('Déléguée de la commission des sports');
        $membresSport = $repo->findByFonction('Membre de la commission des sports');

        $chefEmploi = $repo->findByFonction('Déléguée de la commission emploi, formation');
        $membresEmploi = $repo->findByFonction('Membre de la commission emploi, formation');

        $chefScolaire = $repo->findByFonction('Déléguée de la commission des écoles');
        $membresScolaire = $repo->findByFonction('Membre de la commission des écoles');

        $commissions = array();
        $commissions[1] = ['nom' => 'Commission des Finances', 'chef' => $chefFinances, 'membres' => $membresFinances ];
        $commissions[2] = ['nom' => 'Commission petite enfance et jeunesse', 'chef' => $chefEnfance, 'membres' => $membresEnfance ];
        $commissions[3] = ['nom' => 'Commission urbanisme, politique de la ville et environnement', 'chef' => $chefUrbanisme, 'membres' => $membresUrbanisme ];
        $commissions[4] = ['nom' => 'Commission communication', 'chef' => $chefCommunication, 'membres' => $membresCommunication ];
        $commissions[5] = ['nom' => 'Commission culture, fêtes et cérémonies', 'chef' => $chefFete, 'membres' => $membresFete ];
        $commissions[6] = ['nom' => 'Commission travaux et sécurité', 'chef' => $chefTravaux, 'membres' => $membresTravaux ];
        $commissions[7] = ['nom' => 'Commission des sports', 'chef' => $chefSport, 'membres' => $membresSport ];
        $commissions[8] = ['nom' => 'Commission emploi, formation', 'chef' => $chefEmploi, 'membres' => $membresEmploi ];
        $commissions[9] = ['nom' => 'Commission des écoles', 'chef' => $chefScolaire, 'membres' => $membresScolaire ];
        $this->structure['commissions'] = $commissions;

        return $this->render('mairie/commissions.html.twig', $this->structure);
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

    /**
     * @Route("public/associations", name="mairie_associations")
     */
    public function associations()
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Association::class);
        
        $associations = array();
        $types = array('sportive', 'humanitaire-caritative-social', 'loisirs', 'culturelle-artistique');
        
        foreach($types as $type)
        {
            $criteria = array('type' => $type);
            $orderBy = array('type'=>'ASC', 'nom'=>'ASC');
            $associations[$type] = $repo->findBy($criteria, $orderBy, $limit = null, $offset = null);
        }
        
        $this->structure['associations'] = $associations;
        return $this->render('mairie/associations.html.twig', $this->structure);
    }

    /**
     * @Route("public/association/{id}", name="mairie_association")
     */
    public function association($id)
    {
        $this->StructureRender(); 
        $repo = $this->getDoctrine()->getRepository(Association::class);
        
        $association = $repo->find($id);

        $this->structure['association'] = $association;
        return $this->render('mairie/association.html.twig', $this->structure);
    }
}