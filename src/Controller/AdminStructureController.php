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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Structure();
        $variables['classType'] = StructureType::class;
        $variables['pagedebase'] = 'admin/admin_structure/structure_new.html.twig';
        $variables['pagederesultat'] = 'admin_structure_structures_liste';
        $variables['titre'] = "Création d'une structure";
        $variables['texteConfirmation'] = "La structure ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }
    /**
     * Affiche l'ensemble des structures
     * 
     * @Route("/admin/structures", name="admin_structure_structures_liste")
     *
     * @return Response
     */
    public function recupererStructures(StructureRepository $repo):Response {
        $variables['elements'] = "structures";
        $variables['titre'] = "Listing des structures";
        $variables['pagederesultat'] = "admin/admin_structure/structures_liste.html.twig";
        return $this->findAll($repo, $variables);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'une structure
     *
     * @Route("/admin/admin_structure/structure/{id}/edit", name="admin_structure_structure_edit")
     * @return Response
     */
    public function editStructure(Structure $structure, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $structure;
        $variables['classType'] = StructureType::class;
        $variables['pagedebase'] = 'admin/admin_structure/structure_edit.html.twig';
        $variables['pagederesultat'] = 'admin_structure_structures_liste';
        $variables['titre'] = "Edition de la structure ".$structure->getNom().".";
        $variables['texteConfirmation'] = "La structure ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new Horaire();
        $structure = $repo->find($structure_id);
        $element->setStructure($structure);
        $variables['element'] = $element;
        $variables['classType'] = HoraireType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_structure_structure_edit';
        $options['pagederesultatConfig'] = array('id' => $structure_id);
        $variables['titre'] = "Création d'un horaire";
        $variables['texteConfirmation'] = "L'horaire ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }    
    
    /**
     * Permet d'afficher le formulaire d'édition d'un horaire
     *
     * @Route("/admin/admin_structure/horaire/{id}/edit", name="admin_structure_horaire_edit")
     * @return Response
     */
    public function editHoraire(Horaire $horaire, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $horaire;
        $variables['classType'] = HoraireType::class;
        $variables['pagedebase'] = 'admin/admin_structure/horaire_edit.html.twig';
        $variables['pagederesultat'] = 'admin_structure_structure_edit';
        $options['pagederesultatConfig'] = array('id' => $horaire->getStructure()->getId());
        $variables['titre'] = "Edition de l'horaire ".$horaire->getNom().".";
        $variables['texteConfirmation'] = "L'horaire ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new HoraireOuverture();
        $horaire = $repo->find($horaire_id);
        $element->setHoraire($horaire);
        $variables['element'] = $element;
        $variables['classType'] = HoraireOuvertureType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_structure_horaire_edit';
        $options['pagederesultatConfig'] = array('id' => $horaire_id);
        $variables['titre'] = "Création d'une ouverture";
        $variables['texteConfirmation'] = "L'ouverture ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getJour();';
        
        return $this->afficherFormulaire($variables, $options);
    }    
    
    /**
     * Permet d'afficher le formulaire d'édition d'une ouverture
     *
     * @Route("/admin/admin_structure/ouverture/{id}/edit", name="admin_structure_ouverture_edit")
     * @return Response
     */
    public function editHoraireOuverture(HoraireOuverture $horaireOuverture, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $horaireOuverture;
        $variables['classType'] = HoraireOuvertureType::class;
        $variables['pagedebase'] = 'admin/admin_structure/ouverture_edit.html.twig';
        $variables['pagederesultat'] = 'admin_structure_horaire_edit';
        $options['pagederesultatConfig'] = array('id' => $horaireOuverture->getHoraire()->getId());
        $variables['titre'] = "Edition de l'ouverture ".$horaireOuverture->getJour().".";
        $variables['texteConfirmation'] = "L'ouverture du ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getJour();';
        
        return $this->afficherFormulaire($variables, $options);
    }
}
