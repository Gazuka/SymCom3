<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class ElementService
{

    private $manager;
    //private $request;
    private $entityClass;
    private $element;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }

    public function getEntityClass(){
        return $this->entityClass;
    }
    public function setEntityClass($entityClass){
        $this->entityClass = $entityClass;
        return $this;
    }
    public function getElement(){
        return $this->element;
    }
    public function setElement($element){
        $this->element = $element;
        return $this;
    }

    /**
     * Création d'un formulaire pour un nouveau element (objet entity)
     * @return Response
     */
    public function creerElement($toto){
        dump('coucou');
        //die();
        $form = $toto->createForm($this->entityClass, $this->element);        
        /*$form->handleRequest($request);
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
                "L'élément : <strong>{$element->getNom()}</strong> a bien été créé !"
            );
            //Affichage de la liste des elements apres l'ajout du nouveau
            return $this->redirectToRoute($pagederesultat);
        }
        //Affichage de la page avec le formulaire
        return $this->render($pagedebase, [
            'form' => $form->createView(),
            'titre' => $titre
        ]);*/
    }
}