<?php

namespace App\Controller;

use App\Entity\Humain;
use App\Entity\Mission;
use App\Entity\Fonction;
use App\Form\HumainType;
use App\Form\FonctionType;
use App\Controller\OutilsController;
use App\Repository\HumainRepository;
use App\Repository\MissionRepository;
use App\Repository\FonctionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminRepertoireController extends OutilsController
{
    /** GESTION DES FONCTIONS **********************************************************************************************************************************************************/
    
    /**
     * Création d'une fonction
     * 
     * @Route("/admin/repertoire/fonction/new", name="admin_repertoire_fonction_new")
     *
     * @return Response
     */
    public function creerFonction(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Fonction();
        $variables['classType'] = FonctionType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_repertoire_fonctions_liste';
        $variables['titre'] = "Création d'une fonction";
        //$options['dependances'] = array('Humains' => 'Fonction');
        $variables['texteConfirmation'] = "La fonction ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';        
        
        return $this->afficherFormulaire($variables, $options);
    }
    /**
     * Affiche l'ensemble des fonctions
     * 
     * @Route("/admin/repertoire", name="admin_repertoire_fonctions_liste")
     *
     * @return Response
     */
    public function recupererFonctions(FonctionRepository $repo):Response {
        $variables['elements'] = "Fonctions";
        $variables['titre'] = "Listing des fonctions";
        $variables['pagederesultat'] = "admin/admin_repertoire/fonctions_liste.html.twig";
        return $this->findAll($repo, $variables);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'une fonction
     *
     * @Route("/admin/admin_repertoire/fonction/{id}/edit", name="admin_repertoire_fonction_edit")
     * @return Response
     */
    public function editFonction(Fonction $fonction, Request $request, ObjectManager $manager, HumainRepository $repoHumain):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $fonction;
        $variables['classType'] = FonctionType::class;
        $variables['pagedebase'] = 'admin/element_edit.html.twig';
        $variables['pagederesultat'] = 'admin_repertoire_fonctions_liste';
        $variables['titre'] = "Edition de ".$fonction->getNom().".";
        //$options['dependances'] = array('Humains' => 'Fonction');
        //$variables['deletes'][1] = array('findBy' => 'fonctions', 'classEnfant' => 'Humain', 'repo' => $repoHumain );
        $variables['texteConfirmation'] = "La fonction ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';        
        
        return $this->afficherFormulaire($variables, $options);
    }

    /** GESTION DES HUMAINS **********************************************************************************************************************************************************/
    
    /**
     * Création d'un humain
     * 
     * @Route("/admin/repertoire/humain/new", name="admin_repertoire_humain_new")
     *
     * @return Response
     */
    public function creerHumain(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Humain();
        $variables['classType'] = HumainType::class;
        $variables['pagedebase'] = 'admin/admin_repertoire/humain_new.html.twig';
        $variables['pagederesultat'] = 'admin_repertoire_humains_liste';
        $variables['titre'] = "Création d'une personne";
        $variables['dependances'] = array('Missions' => 'Humain');
        $variables['texteConfirmation'] = "### ZZZ a bien été ajouté(e) au répertoire !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';        
        $options['texteConfirmationEval']["ZZZ"] = '$element->getPrenom();';
        
        return $this->afficherFormulaire($variables, $options);
    }

    /**
     * Affiche l'ensemble des humains
     * 
     * @Route("/admin/repertoire/humains", name="admin_repertoire_humains_liste")
     *
     * @return Response
     */
    public function recupererHumains(HumainRepository $repo):Response {
        $variables['elements'] = "Humains";
        $variables['titre'] = "Listing du répertoire";
        $variables['pagederesultat'] = "admin/admin_repertoire/humains_liste.html.twig";        
        return $this->findAll($repo, $variables);        
    }

    /**
     * Affiche une partie des humains
     * 
     * @Route("/admin/repertoire/humains/{type}", name="admin_repertoire_humains_liste_type")
     *
     * @return Response
     */
    public function recupererHumains2(HumainRepository $repo, $type):Response {
        $variables['elements'] = "Humains";
        $variables['titre'] = "Listing du répertoire";
        $variables['pagederesultat'] = "admin/admin_repertoire/humains_liste.html.twig";
        //$options['findby'] = array('fonction.type' => $type);
        $options['findspecial'] = 'test';
        //$orderby = array($sort => 'ASC');
        return $this->findAll($repo, $variables, $options);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'une personne
     *
     * @Route("/admin/admin_repertoire/humain/{id}/edit", name="admin_repertoire_humain_edit")
     * @return Response
     */
    public function editHumain(Humain $humain, Request $request, ObjectManager $manager,  MissionRepository $repoMission):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $humain;
        $variables['classType'] = HumainType::class;
        $variables['pagedebase'] = 'admin/admin_repertoire/humain_new.html.twig';
        $variables['pagederesultat'] = 'admin_repertoire_humains_liste';
        $variables['titre'] = "Edition de ".$humain->getNom()." ".$humain->getPrenom().".";
        $options['dependances'] = array('Missions' => 'Humain');
        $variables['texteConfirmation'] = "La fiche de ### ZZZ a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        $options['texteConfirmationEval']["###"] = '$element->getPrenom();';
        $options['deletes'] = array(array('findBy' => 'humain', 'classEnfant' => 'missions', 'repo' => $repoMission ));
        
        return $this->afficherFormulaire($variables, $options);
    }

    /**
     * Permet de supprimer la mission d'une personne
     *
     * @Route("/admin/admin_repertoire/mission/{id}/delete", name="admin_repertoire_mission_delete")
     * @return Response
     */
    public function deleteMission(Mission $mission, ObjectManager $manager):Response {
        $variables['manager'] = $manager;
        $variables['element'] = $mission;        
        $variables['pagederesultat'] = 'admin_repertoire_humains_liste';          
        return $this->deleteElement($variables);
    }
    
}
