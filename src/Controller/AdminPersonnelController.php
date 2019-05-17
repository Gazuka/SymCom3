<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Entity\PersonnelFonction;
use App\Form\PersonnelFonctionType;
use App\Controller\OutilsController;
use App\Repository\PersonnelRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PersonnelFonctionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPersonnelController extends OutilsController
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

    /** GESTION DU PERSONNEL ***********************************************************************************************************************************************************/
    /**
     * Création d'un personnel
     * 
     * @Route("/admin/personnel/new", name="admin_personnel_personnel_new")
     *
     * @return Response
     */
    public function creerPersonnel(Request $request, ObjectManager $manager):Response {
        $element = new Personnel();
        $class = PersonnelType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_personnel_personnels_liste';
        $titre = "Création d'une personne";  
        //$dependances = array('Events' => 'Agenda');      
        $dependances = null;      
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }    
    /**
     * Affiche l'ensemble du personnels
     * 
     * @Route("/admin/personnels", name="admin_personnel_personnels_liste")
     *
     * @return Response
     */
    public function recupererPersonnels(PersonnelRepository $repo):Response {
        $elements = "personnels";
        $titre = "Listing des personnes";
        $pagederesultat = "admin/admin_personnel/personnels_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un agenda
     *
     * @Route("/admin/admin_personnel/personnel/{id}/edit", name="admin_personnel_personnel_edit")
     * @return Response
     */
    public function editPersonnel(Personnel $personnel, Request $request, ObjectManager $manager):Response {
        $element = $personnel;
        $classType = PersonnelType::class;
        $pagederesultat = "admin/element_edit.html.twig";
        //$dependances = array('Events' => 'Agenda');
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }

    /** GESTION DES FONCTIONS **********************************************************************************************************************************************************/
    /**
     * Création d'une fonction
     * 
     * @Route("/admin/fonction/new", name="admin_personnel_fonction_new")
     *
     * @return Response
     */
    public function creerPersonnelFonction(Request $request, ObjectManager $manager):Response {
        $element = new PersonnelFonction();
        $class = PersonnelFonctionType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_personnel_fonctions_liste';
        $titre = "Création d'une fonction";  
        //$dependances = array('Events' => 'Agenda');      
        $dependances = null;      
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }    
    /**
     * Affiche l'ensemble des fonctions
     * 
     * @Route("/admin/fonctions", name="admin_personnel_fonctions_liste")
     *
     * @return Response
     */
    public function recupererPersonnelFonctions(PersonnelFonctionRepository $repo):Response {
        $elements = "personnelFonctions";
        $titre = "Listing des fonctions";
        $pagederesultat = "admin/admin_personnel/fonctions_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'une fonction
     *
     * @Route("/admin/admin_personnel/fonction/{id}/edit", name="admin_personnel_fonction_edit")
     * @return Response
     */
    public function editPersonnelFonction(PersonnelFonction $personnelFonction, Request $request, ObjectManager $manager):Response {
        $element = $personnelFonction;
        $classType = PersonnelFonctionType::class;
        $pagederesultat = "admin/element_edit.html.twig";
        //$dependances = array('Events' => 'Agenda');
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }
}
