<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\PhotoType;
use App\Form\DragDropPhotoType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPhotoController extends AbstractController
{
    private $cheminDesPhotos = "photo_tmp/";
    private $cheminDesPhotosPublics = "photo/";
    private $type;
    
    protected function formDragDrop(Request $request)
    {
        //On crée le formulaire
        $form = $this->createForm(DragDropPhotoType::class);
        $form->handleRequest($request);

        //On vérifie si il est Valide
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $file = $form['attachment']->getData();
            $someNewFilename = $file->getClientOriginalName();
            $file->move($this->cheminDesPhotos.$this->type, $someNewFilename); ///////////???????????? a vérifier
        }

        //On crée la vue du formulaire
        $form = $form->createView();

        return $form;
    }

    /** Liste les photos orphelines
     * @Route("/admin/photos/{type}", name="admin_photo")
     */
    public function index(Request $request, ObjectManager $manager, string $type)
    {
        //Si le dossier des photos à traiter n'existe pas nous le créont
        if(!file_exists ($this->cheminDesPhotos)){mkdir($this->cheminDesPhotos);}
        if(!file_exists ($this->cheminDesPhotosPublics)){mkdir($this->cheminDesPhotosPublics);}

        $this->type = "$type/";
        $photos = $this->recherchePhotosOrphelines();

        $formDrag = $this->formDragDrop($request);

        if(sizeof($photos)!=0)
        {
            $photo = $photos[0];
            $form = $this->createForm(PhotoType::class, $photo);
            //On prépare l'envoi vers le twig
            //On vérifie si un formulaire est valide
            $form->handleRequest($request);

            
            //On vérifie que le formulaire soit Soumis et valide
            if($form->isSubmitted() && $form->isValid()) 
            {
                //On déplace la photo
                //Si le dossier n'existe pas on le crée
                if(!file_exists ($this->cheminDesPhotosPublics.$this->type)){mkdir($this->cheminDesPhotosPublics.$this->type);}
                $nom = $photo->getChemin();
                $nouveau = $this->type.time()."_".$nom;
                $photo->setChemin($nouveau);
                rename($this->cheminDesPhotos.$this->type.$nom, $this->cheminDesPhotosPublics.$nouveau);
                
                //On persist l'élément
                $photo->setType($type);
                $manager->persist($photo);
                //On enregistre le tout
                $manager->flush();
                return $this->redirectToRoute('admin_photo', ['type' => $type]);
            }   
            $form = $form->createView();

            return $this->render('/admin/admin_photo/index.html.twig', [
                'controller_name' => 'AdminPhotoController',
                'titre' => 'Recherche des Photos orphelines',
                'form' => $form,
                'photo' => $photo,
                'fini' => false,
                'photoRestant' => sizeof($photos),
                'dossier' => $this->type,
                'formdrag' => $formDrag
            ]);
        }
        else
        {
            return $this->render('/admin/admin_photo/index.html.twig', [
                'controller_name' => 'AdminPhotoController',
                'titre' => 'Recherche des Photos orphelines',
                'fini' => true,
                'photoRestant' => 0,
                'formdrag' => $formDrag
            ]);
        }
        
    }

    /** Recherche tous les fichier photo du dossier "$cheminDesPhoto"
     * 
     * 
     * @return Array
     */
    private function recherchePhotosOrphelines()
    {
        if(file_exists ($this->cheminDesPhotos.$this->type))
        {
            $photos = scandir($this->cheminDesPhotos.$this->type);        
            $photos = array_map(array($this, 'recherchePhotosOrphelines_2'), $photos);
            $photos = array_values(array_filter($photos));
        }
        else
        {
            $photos = array();
        }
        return $photos;
    }
    private function recherchePhotosOrphelines_2($nomFichier)
    {
        if(is_dir($this->cheminDesPhotos.$nomFichier) || !stristr($this->cheminDesPhotos.$nomFichier, '.jpg'))
        {
            return false;
        }
        else
        {
            $photo = new Photo();
            $photo->setChemin($nomFichier);
            return $photo;
        }        
    } 
}
