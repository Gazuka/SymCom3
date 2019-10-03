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
     * @Route("/admin/personnel", name="admin_personnel")
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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Personnel();
        $variables['classType'] = PersonnelType::class;
        $variables['pagedebase'] = 'admin/admin_personnel/personnel_new.html.twig';
        $variables['pagederesultat'] = 'admin_personnel_personnels_liste';
        $variables['titre'] = "Création d'une personne";
        $options['dependances'] = array('Fonctions' => 'Personnel');
        $variables['texteConfirmation'] = "Le membre du personnel ### ZZZ a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        $options['texteConfirmationEval']["ZZZ"] = '$element->getPrenom();';
        
        return $this->afficherFormulaire($variables, $options);
    }    
    /**
     * Affiche l'ensemble du personnels
     * 
     * @Route("/admin/personnels", name="admin_personnel_personnels_liste")
     *
     * @return Response
     */
    public function recupererPersonnels(PersonnelRepository $repo):Response {
        $variables['elements'] = "personnels";
        $variables['titre'] = "Listing des personnes";
        $variables['pagederesultat'] = "admin/admin_personnel/personnels_liste.html.twig";
        return $this->findAll($repo, $variables);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'un agenda
     *
     * @Route("/admin/admin_personnel/personnel/{id}/edit", name="admin_personnel_personnel_edit")
     * @return Response
     */
    public function editPersonnel(Personnel $personnel, Request $request, ObjectManager $manager, PersonnelFonctionRepository $repoFonction):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $personnel;
        $variables['classType'] = PersonnelType::class;
        $variables['pagedebase'] = 'admin/admin_personnel/personnel_new.html.twig';
        $variables['pagederesultat'] = 'admin_personnel_personnels_liste';
        $variables['titre'] = "Edition de ".$personnel->getNom()." ".$personnel->getPrenom().".";
        $options['dependances'] = array('Fonctions' => 'Personnel');
        $variables['texteConfirmation'] = "La fiche de ### ZZZ a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        $options['texteConfirmationEval']["ZZZ"] = '$element->getPrenom();';
        $options['deletes'][1] = array('findBy' => 'personnel', 'classEnfant' => 'Fonctions', 'repo' => $repoFonction );
        
        return $this->afficherFormulaire($variables, $options);
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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new PersonnelFonction();
        $variables['classType'] = PersonnelFonctionType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_personnel_fonctions_liste';
        $variables['titre'] = "Création d'une fonction";
        $variables['texteConfirmation'] = "La fonction ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }    

    /**
     * Affiche l'ensemble des fonctions
     * 
     * @Route("/admin/fonctions", name="admin_personnel_fonctions_liste")
     *
     * @return Response
     */
    public function recupererPersonnelFonctions(PersonnelFonctionRepository $repo):Response {
        $variables['elements'] = "personnelFonctions";
        $variables['titre'] = "Listing des fonctions";
        $variables['pagederesultat'] = "admin/admin_personnel/fonctions_liste.html.twig";
        return $this->findAll($repo, $variables);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'une fonction
     *
     * @Route("/admin/admin_personnel/fonction/{id}/edit", name="admin_personnel_fonction_edit")
     * @return Response
     */
    public function editPersonnelFonction(PersonnelFonction $personnelFonction, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $personnelFonction;
        $variables['classType'] = PersonnelFonctionType::class;
        $variables['pagedebase'] = 'admin/element_edit.html.twig';
        $variables['pagederesultat'] = 'admin_personnel_fonctions_liste';
        $variables['titre'] = "Edition de la fonction ".$personnelFonction->getNom().".";
        $variables['texteConfirmation'] = "La fonction ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }
}
