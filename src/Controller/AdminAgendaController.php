<?php

namespace App\Controller;

use App\Entity\Agenda;
use App\Form\AgendaType;
use App\Entity\AgendaEvent;
use App\Form\AgendaEventType;
use App\Repository\AgendaRepository;
use App\Repository\AgendaEventRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAgendaController extends AbstractController
{
    /**
     * @Route("/admin/agenda", name="admin_agenda")
     */
    public function index()
    {
        return $this->render('admin_agenda/index.html.twig', [
            'controller_name' => 'AdminAgendaController',
        ]);
    }

    /** FONCTIONS DE SIMPLIFICATION DU CODE ***********************************************************************************************************************************************/
    /**
     * Création d'un formulaire pour un nouveau element (objet entity)
     * @return Response
     */
    private function creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre):Response{
        $form = $this->createForm($class, $element);        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($element);
            $manager->flush();
            $this->addFlash(
                'success',
                "L'élément : <strong>{$element->getNom()}</strong> a bien été créé !"
            );
            //Affichage de la liste des elements apres l'ajout du nouveau
            return $this->redirectToRoute($pagederesultat);
        }
        //Affichage de la page avec le formulaire
        return $this->render($pagedebase, [
            'form' => $form->createView(),
            'titre' => $titre
        ]);
    }
    /**
     * Affichage de l'ensemble des éléments
     *
     * @return Response
     */
    private function recupererElements($repo, $elements, $titre, $pagederesultat):Response {
        $recup = $repo->findAll();
        return $this->render($pagederesultat, [
            'titre' => $titre,
            $elements => $recup
        ]);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un élément
     * @return Response
     */
    public function editElement($element, $classType, $pagederesultat, $request, $manager):Response {
        $form = $this->createForm($classType, $element);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($element);
            $manager->flush();
            $this->addFlash(
                'success',
                "L'élément' <strong>{$element->getNom()}</strong> a bien été enregistrée !"
            );
        }
        return $this->render($pagederesultat, [
            'element' => $element,
            'form' => $form->createView()
        ]);
    }

    /** GESTION DES AGENDAS ************************************************************************************************************************************************************/
    /**
     * Création d'un agenda
     * 
     * @Route("/admin/agenda/new", name="admin_agenda_agenda_new")
     *
     * @return Response
     */
    public function creerAgenda(Request $request, ObjectManager $manager):Response {
        $element = new Agenda();
        $class = AgendaType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_agenda_agendas_liste';
        $titre = "Création d'un agenda";
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre);
    }    
    /**
     * Affiche l'ensemble des agendas
     * 
     * @Route("/admin/agendas", name="admin_agenda_agendas_liste")
     *
     * @return Response
     */
    public function recupererAgendas(AgendaRepository $repo):Response {
        $elements = "agendas";
        $titre = "Listing des agendas";
        $pagederesultat = "admin/admin_agenda/agendas_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un agenda
     *
     * @Route("/admin/admin_agenda/agenda/{id}/edit", name="admin_agenda_agenda_edit")
     * @return Response
     */
    public function editAgenda(Agenda $agenda, Request $request, ObjectManager $manager):Response {
        $element = $agenda;
        $classType = AgendaType::class;
        $pagederesultat = "admin/element_edit.html.twig";
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager);
    }

    /** GESTION DES EVENEMENTS D'AGENDAS ***********************************************************************************************************************************************/
    /**
     * Création d'un evenement d'agenda
     * 
     * @Route("/admin/evenement/new", name="admin_agenda_evenement_new")
     *
     * @return Response
     */
    public function creerAgendaEvent(Request $request, ObjectManager $manager):Response {
        $element = new AgendaEvent();
        $class = AgendaEventType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_agenda_evenements_liste';
        $titre = "Création d'un évenemeent d'agenda";
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre);
    }    
    /**
     * Affiche l'ensemble des évenements d'agendas
     * 
     * @Route("/admin/evenements", name="admin_agenda_evenements_liste")
     *
     * @return Response
     */
    public function recupererAgendaEvents(AgendaEventRepository $repo):Response {
        $elements = "evenements";
        $titre = "Listing des évenements d'agendas";
        $pagederesultat = "admin/admin_agenda/evenements_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un évenement d'agenda
     *
     * @Route("/admin/admin_agenda/evenement/{id}/edit", name="admin_agenda_evenement_edit")
     * @return Response
     */
    public function editAgendaevent(AgendaEvent $agendaevent, Request $request, ObjectManager $manager):Response {
        $element = $agendaevent;
        $classType = AgendaEventType::class;
        $pagederesultat = "admin/element_edit.html.twig";
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager);
    }
}
