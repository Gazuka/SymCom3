<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OutilsController extends AbstractController
{
    /** FONCTIONS DE SIMPLIFICATION DU CODE ***********************************************************************************************************************************************/
    /**
     * Création d'un formulaire pour un nouveau element (objet entity)
     * @return Response
     */
    protected function creerElement($element, $request, $manager, $class, $pagedebase, $pagederesultat, $titre, $dependances = null):Response{
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
                "L'élément : a bien été créé !"
            );
            
            if(is_array($pagederesultat))
            {
                //Affichage de la liste des elements avec l'id
                return $this->redirectToRoute($pagederesultat['page'], $pagederesultat);
            }
            else
            {
                //Affichage de la liste des elements apres l'ajout du nouveau
                return $this->redirectToRoute($pagederesultat);
            }
            
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
    protected function recupererElements($repo, $elements, $titre, $pagederesultat):Response {
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
    protected function editElement($element, $classType, $pagederesultat, $request, $manager, $dependances = null):Response {
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
                "L'élément' a bien été enregistrée !"
            );
        }
        return $this->render($pagederesultat, [
            'element' => $element,
            'form' => $form->createView()
        ]);
    }
}