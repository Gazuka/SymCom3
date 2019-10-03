<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\AssociationType;
use App\Repository\MissionRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAssociationController extends OutilsController
{
    /**
     * @Route("/admin/association", name="admin_association")
     */
    public function index()
    {
        return $this->render('admin_association/index.html.twig', [
            'controller_name' => 'AdminAssociationController',
        ]);
    }

    /** GESTION DES ASSOCIATIONS **********************************************************************************************************************************************************/
    
    /**
     * Création d'une association
     * 
     * @Route("/admin/association/new", name="admin_association_new")
     *
     * @return Response
     */
    public function creerAssociation(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Association();
        $variables['classType'] = AssociationType::class;
        $variables['pagedebase'] = 'admin/admin_association/association_new.html.twig';
        $variables['pagederesultat'] = 'admin_associations_liste';
        $variables['titre'] = "Création d'une association";
        $options['dependances'] = array('Missions' => 'Association');
        $variables['texteConfirmation'] = "L'association ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';        
        
        return $this->afficherFormulaire($variables, $options);
    }
    /**
     * Affiche l'ensemble des associations
     * 
     * @Route("/admin/associations", name="admin_associations_liste")
     *
     * @return Response
     */
    public function recupererAssociations(AssociationRepository $repo):Response {
        $variables['elements'] = "Associations";
        $variables['titre'] = "Listing des associations";
        $variables['pagederesultat'] = "admin/admin_association/associations_liste.html.twig";
        return $this->findAll($repo, $variables);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'une association
     *
     * @Route("/admin/association/{id}/edit", name="admin_association_edit")
     * @return Response
     */
    public function editAssociation(Association $association, Request $request, ObjectManager $manager, MissionRepository $repoMission):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $association;
        $variables['classType'] = AssociationType::class;
        $variables['pagedebase'] = 'admin/admin_association/association_new.html.twig';
        $variables['pagederesultat'] = 'admin_associations_liste';
        $variables['titre'] = "Edition de ".$association->getNom().".";
        $options['dependances'] = array('Missions' => 'Association');
        $options['deletes'] = array(array('findBy' => 'association', 'classEnfant' => 'missions', 'repo' => $repoMission ));
        $variables['texteConfirmation'] = "L'association ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';        
        
        return $this->afficherFormulaire($variables, $options);
    }
}
