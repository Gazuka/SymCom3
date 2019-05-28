<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Entity\MenuLien;
use App\Entity\MenuCateg;
use App\Form\MenuLienType;
use App\Form\MenuCategType;
use App\Repository\MenuRepository;
use App\Repository\MenuCategRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMenuController extends OutilsController
{
    /**
     * @Route("/admin/menu", name="admin_menu")
     */
    public function index()
    {
        return $this->render('admin_menu/index.html.twig', [
            'controller_name' => 'AdminMenuController',
        ]);
    }

    /** GESTION DES MENUS **************************************************************************************************************************************************************/
    /**
     * Création d'un menu
     * 
     * @Route("/admin/menu/new", name="admin_menu_menu_new")
     *
     * @return Response
     */
    public function creerMenu(Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = new Menu();
        $variables['classType'] = MenuType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Création d'un menu";
        $variables['texteConfirmation'] = "Le menu ### a bien été créé !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    } 

    /**
     * Affiche l'ensemble des menus
     * 
     * @Route("/admin/menus", name="admin_menu_menus_liste")
     *
     * @return Response
     */
    public function recupererMenus(MenuRepository $repo):Response {
        $elements = "menus";
        $titre = "Listing des menus";
        $pagederesultat = "admin/admin_menu/menus_liste.html.twig";
        return $this->recupererElements($repo, $elements, $titre, $pagederesultat);
    }

    /**
     * Permet d'afficher le formulaire d'édition d'un menu
     *
     * @Route("/admin/admin_menu/menu/{id}/edit", name="admin_menu_menu_edit")
     * @return Response
     */
    public function editMenu(Menu $menu, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $menu;
        $variables['classType'] = MenuType::class;
        $variables['pagedebase'] = 'admin/admin_menu/menu_edit.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Edition du menu ".$menu->getTitre().".";
        $variables['texteConfirmation'] = "Le menu ### a bien été modifié !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }

    /** GESTION DES CATEGORIES DE MENUS ************************************************************************************************************************************************/
    /**
     * Création d'une catégorie de menu
     * 
     * @Route("/admin/menu/categ/{id}/new", name="admin_menu_categ_new")
     *
     * @return Response
     */
    public function creerMenuCateg(Request $request, ObjectManager $manager, MenuRepository $repoMenu, $id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new MenuCateg();
        $menu = $repoMenu->find($id);
        $element->setMenu($menu);
        $variables['element'] = $element;
        $variables['classType'] = MenuCategType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Création d'une catégorie pour le menu";
        $variables['dependances'] = array('Menu' => 'MenuCateg');
        $variables['texteConfirmation'] = "La catégorie ### a bien été créé !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }  
    
    /**
     * Permet d'afficher le formulaire d'édition d'une catégorie de menu
     *
     * @Route("/admin/admin_menu/menucateg/{id}/edit", name="admin_menu_categ_edit")
     * @return Response
     */
    public function editMenuCateg(MenuCateg $menuCateg, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $menuCateg;
        $variables['classType'] = MenuCategType::class;
        $variables['pagedebase'] = 'admin/admin_menu/menucateg_edit.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Edition de la catégorie ".$menu->getTitre().".";
        $variables['texteConfirmation'] = "La catégorie ### a bien été modifié !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }

    /** GESTION DES LIENS **************************************************************************************************************************************************************/
    /**
     * Création d'un lien d'une catégorie de menu
     * 
     * @Route("/admin/menu/lien/{id}/new", name="admin_menu_lien_new")
     *
     * @return Response
     */
    public function creerMenuLien(Request $request, ObjectManager $manager, MenuCategRepository $repoMenuCateg, $id):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $element = new MenuLien();
        $menuCateg = $repoMenuCateg->find($id);
        $element->setCateg($menuCateg);
        $variables['element'] = $element;
        $variables['classType'] = MenuLienType::class;
        $variables['pagedebase'] = 'admin/element_new.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Création d'un lien pour le menu";
        $variables['texteConfirmation'] = "Le lien ### a bien été créé !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }  
    
    /**
     * Permet d'afficher le formulaire d'édition d'un lien d'une catégorie de menu
     *
     * @Route("/admin/admin_menu/lien/{id}/edit", name="admin_menu_lien_edit")
     * @return Response
     */
    public function editMenuLien(MenuLien $menuLien, Request $request, ObjectManager $manager):Response {
        $variables['request'] = $request;
        $variables['manager'] = $manager;
        $variables['element'] = $menuLien;
        $variables['classType'] = MenuLienType::class;
        $variables['pagedebase'] = 'admin/admin_menu/menulien_edit.html.twig';
        $variables['pagederesultat'] = 'admin_menu_menus_liste';
        $variables['titre'] = "Edition du lien ".$menuLien->getTitre().".";
        $variables['texteConfirmation'] = "Le lien ### a bien été modifié !";
        $variables['texteConfirmationEval']["###"] = '$element->getTitre();';
        
        return $this->formElement($variables);
    }
}
