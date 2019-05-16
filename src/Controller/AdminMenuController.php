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

class AdminMenuController extends AbstractController
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

    /** FONCTIONS DE SIMPLIFICATION DU CODE ***********************************************************************************************************************************************/
    /**
     * Création d'un formulaire pour un nouveau element (objet entity)
     * @return Response
     */
    private function creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances = null):Response{
        $form = $this->createForm($class, $element);        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($element);
            //Persist des dependances
            if($dependances != null)
            {
                foreach($dependances as $dependance => $elem)
                {
                    eval('$objets = $element->get'.$dependance.'();');
                    foreach($objets as $objet)
                    {
                        eval('$objet->add'.$elem.'($element);'); //add pour ManyToMany --> set pour le reste... voir comment le gérer...
                        $manager->persist($objet);
                    }
                }
            }  
            $manager->flush();
            $this->addFlash(
                'success',
                "L'élément a bien été créé !"
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
    public function editElement($element, $classType, $pagederesultat, $request, $manager, $dependances = null):Response {
        $form = $this->createForm($classType, $element);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($element);
            //Persist des dependances
            if($dependances != null)
            {
                foreach($dependances as $dependance => $elem)
                {
                    eval('$objets = $element->get'.$dependance.'();');
                    foreach($objets as $objet)
                    {
                        eval('$objet->add'.$elem.'($element);');  //add pour ManyToMany --> set pour le reste... voir comment le gérer...
                        $manager->persist($objet);
                    }
                }
            }  
            $manager->flush();
            $this->addFlash(
                'success',
                "L'élément a bien été enregistrée !"
            );
        }
        return $this->render($pagederesultat, [
            'element' => $element,
            'form' => $form->createView()
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
        $element = new Menu();
        $class = MenuType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_menu_menus_liste';
        $titre = "Création d'un menu";      
        $dependances = null;
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
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
        $element = $menu;
        $classType = MenuType::class;
        $pagederesultat = "admin/admin_menu/menu_edit.html.twig";
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
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
        $element = new MenuCateg();
        $menu = $repoMenu->find($id);
        $element->setMenu($menu);
        $class = MenuCategType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_menu_menus_liste';
        $titre = "Création d'une catégorie pour le menu";      
        $dependances = array('Menu' => 'MenuCateg');
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }  
    
    /**
     * Permet d'afficher le formulaire d'édition d'une catégorie de menu
     *
     * @Route("/admin/admin_menu/menucateg/{id}/edit", name="admin_menu_categ_edit")
     * @return Response
     */
    public function editMenuCateg(MenuCateg $menuCateg, Request $request, ObjectManager $manager):Response {
        $element = $menuCateg;
        $classType = MenuCategType::class;
        $pagederesultat = "admin/admin_menu/menucateg_edit.html.twig";
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
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
        $element = new MenuLien();
        $menuCateg = $repoMenuCateg->find($id);
        $element->setCateg($menuCateg);
        $class = MenuLienType::class;
        $pagedebase = 'admin/element_new.html.twig';
        $pagederesultat = 'admin_menu_menus_liste';
        $titre = "Création d'un lien pour le menu";      
        $dependances = array('Categ' => 'Lien');
        return $this->creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances);
    }  
    
    /**
     * Permet d'afficher le formulaire d'édition d'un lien d'une catégorie de menu
     *
     * @Route("/admin/admin_menu/lien/{id}/edit", name="admin_menu_lien_edit")
     * @return Response
     */
    public function editMenuLien(MenuLien $menuLien, Request $request, ObjectManager $manager):Response {
        $element = $menuLien;
        $classType = MenuLienType::class;
        $pagederesultat = "admin/admin_menu/menulien_edit.html.twig";
        $dependances = null;
        return $this->editElement($element, $classType, $pagederesultat, $request, $manager, $dependances);
    }
}
