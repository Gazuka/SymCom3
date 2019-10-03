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

class AdminAgendaController extends OutilsController
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

    /** GESTION DES AGENDAS ************************************************************************************************************************************************************/
    /**
     * Création d'un agenda
     * 
     * @Route("/admin/agenda/new", name="admin_agenda_agenda_new")
     *
     * @return Response
     */
    public function creerAgenda(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Agenda();
        $variables['classType'] = AgendaType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_agenda_agendas_liste';
        $variables['titre'] = "Création d'un agenda";
        $options['dependances'] = array('Events' => 'Agenda');
        $variables['texteConfirmation'] = "L'agenda ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }    
    /**
     * Affiche l'ensemble des agendas
     * 
     * @Route("/admin/agendas", name="admin_agenda_agendas_liste")
     *
     * @return Response
     */
    public function recupererAgendas(AgendaRepository $repo):Response {
        $variables['elements'] = "agendas";
        $variables['titre'] = "Listing des agendas";
        $variables['pagederesultat'] = "admin/admin_agenda/agendas_liste.html.twig";
        return $this->findAll($repo, $variables);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un agenda
     *
     * @Route("/admin/admin_agenda/agenda/{id}/edit", name="admin_agenda_agenda_edit")
     * @return Response
     */
    public function editAgenda(Agenda $agenda, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $agenda;
        $variables['classType'] = AgendaType::class;
        $variables['pagedebase'] = 'admin/element_edit.html.twig';
        $variables['pagederesultat'] = 'admin_agenda_agendas_liste';
        $variables['titre'] = "Edition de l'agenda ".$agenda->getNom().".";
        $options['dependances'] = array('Events' => 'Agenda');
        $variables['texteConfirmation'] = "L'agenda ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
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
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new AgendaEvent();
        $variables['classType'] = AgendaEventType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_agenda_evenements_liste';
        $variables['titre'] = "Création d'un événement";
        $options['dependances'] = array('Agendas' => 'Event');
        $variables['texteConfirmation'] = "L'événement ### a bien été créé !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }    
    /**
     * Affiche l'ensemble des évenements d'agendas
     * 
     * @Route("/admin/evenements", name="admin_agenda_evenements_liste")
     *
     * @return Response
     */
    public function recupererAgendaEvents(AgendaEventRepository $repo):Response {
        $variables['elements'] = "evenements";
        $variables['titre'] = "Listing des évenements d'agendas";
        $variables['pagederesultat'] = "admin/admin_agenda/evenements_liste.html.twig";
        return $this->findAll($repo, $variables);
    }
    /**
     * Permet d'afficher le formulaire d'édition d'un évenement d'agenda
     *
     * @Route("/admin/admin_agenda/evenement/{id}/edit", name="admin_agenda_evenement_edit")
     * @return Response
     */
    public function editAgendaevent(AgendaEvent $agendaevent, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $agendaevent;
        $variables['classType'] = AgendaEventType::class;
        $variables['pagedebase'] = 'admin/element_edit.html.twig';
        $variables['pagederesultat'] = 'admin_agenda_evenements_liste';
        $variables['titre'] = "Edition de l'événement ".$agendaevent->getNom().".";
        $options['dependances'] = array('Agendas' => 'Event'); 
        $variables['texteConfirmation'] = "L'événement ### a bien été modifié !";
        $options['texteConfirmationEval']["###"] = '$element->getNom();';
        
        return $this->afficherFormulaire($variables, $options);
    }
}
