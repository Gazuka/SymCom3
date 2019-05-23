<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Structure;
use App\Form\HoraireType;
use App\Form\StructureType;
use App\Entity\HoraireOuverture;
use App\Form\HoraireOuvertureType;
use App\Controller\OutilsController;
use App\Repository\HoraireRepository;
use App\Repository\StructureRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStructureController extends OutilsController
{
    /**
     * @Route("/admin/structure", name="admin_structure")
     */
    public function index()
    {
        return $this->render('admin_structure/index.html.twig', [
            'controller_name' => 'AdminStructureController',
        ]);
    }

    /** GESTION DES STRUCTURES *****************************************************************************************************************************************/
    /**
     * Création d'une structure
     * 
     * @Route("/admin/structure/new", name="admin_structure_structure_new")
     *
     * @return Response
     */
    public function creerStructure(Request $request, ObjectManager $manager):Response {
        $element = new Structure();
        $class = StructureType::class;
        $pagedebase = 'admin/admin_structure/structure_new.html.twig';
        $pagederesultat = 'admin_structure_structures_liste';
        $titre = "Création d'une structure";  
        //$dependances = array('Events' => 'Agenda');      
        $dependances = null;      
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }    
    /**
     * Affiche l'ensemble des structures
     * 
     * @Route("/admin/structures", name="admin_structure_structures_liste")
     *
     * @return Response
     */
    public function recupererStructures(StructureRepository $repo):Response {
        $elements = "structures";
        $titre = "Listing des structures";
        $pagederesultat = "admin/admin_structure/structures_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'une structure
     *
     * @Route("/admin/admin_structure/structure/{id}/edit", name="admin_structure_structure_edit")
     * @return Response
     */
    public function editStructure(Structure $structure, Request $request, ObjectManager $manager):Response {
        $element = $structure;
        $classType = StructureType::class;
        $pagederesultat = "admin/admin_structure/structure_edit.html.twig";
        //$dependances = array('Events' => 'Agenda');
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }

    /** GESTION DES HORAIRES *******************************************************************************************************************************************/
    /**
     * Création d'un horaire
     * 
     * @Route("/admin/horaire/new/{structure_id}", name="admin_structure_horaire_new")
     *
     * @return Response
     */
    public function creerHoraire(Request $request, ObjectManager $manager, StructureRepository $repo, $structure_id):Response {
        $element = new Horaire();
        $structure = $repo->find($structure_id);
        $element->setStructure($structure);        
        $class = HoraireType::class;
        $pagedebase = 'admin/element_new.html.twig';
        //$pagederesultat = 'admin_structure_horaires_liste';
        $pagederesultat = array('page' => 'admin_structure_structure_edit', 'id' => $structure_id);
        $titre = "Création d'un horaire";  
        //$dependances = array('Events' => 'Agenda');      
        $dependances = null;      
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }    
    
    /**
     * Permet d'afficher le formulaire d'édition d'un horaire
     *
     * @Route("/admin/admin_structure/horaire/{id}/edit", name="admin_structure_horaire_edit")
     * @return Response
     */
    public function editHoraire(Horaire $horaire, Request $request, ObjectManager $manager):Response {
        $element = $horaire;
        $classType = HoraireType::class;
        $pagederesultat = "admin/admin_structure/horaire_edit.html.twig";
        //$dependances = array('Events' => 'Agenda');
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }

    /** GESTION DES OUVERTURES *****************************************************************************************************************************************/
    /**
     * Création d'une ouverture
     * 
     * @Route("/admin/ouverture/new/{horaire_id}", name="admin_structure_ouverture_new")
     *
     * @return Response
     */
    public function creerHoraireOuverture(Request $request, ObjectManager $manager, HoraireRepository $repo, $horaire_id):Response {
        $element = new HoraireOuverture();
        $horaire = $repo->find($horaire_id);
        $element->setHoraire($horaire);        
        $class = HoraireOuvertureType::class;
        $pagedebase = 'admin/element_new.html.twig';
        //$pagederesultat = 'admin_structure_horaires_liste';
        $pagederesultat = array('page' => 'admin_structure_horaire_edit', 'id' => $horaire_id);
        $titre = "Création d'une ouverture";  
        //$dependances = array('Events' => 'Agenda');      
        $dependances = null;      
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }    
    
    /**
     * Permet d'afficher le formulaire d'édition d'une ouverture
     *
     * @Route("/admin/admin_structure/ouverture/{id}/edit", name="admin_structure_ouverture_edit")
     * @return Response
     */
    public function editHoraireOuverture(HoraireOuverture $horaireOuverture, Request $request, ObjectManager $manager):Response {
        $element = $horaireOuverture;
        $classType = HoraireOuvertureType::class;
        $pagederesultat = "admin/admin_structure/ouverture_edit.html.twig";
        //$dependances = array('Events' => 'Agenda');
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }
}
